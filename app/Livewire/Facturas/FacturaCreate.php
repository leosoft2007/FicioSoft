<?php

namespace App\Livewire\Facturas;

use Livewire\Component;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Models\Clinica;
use App\Models\Recibo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class FacturaCreate extends Component
{
    public $clinica;
    public $paciente_id;
    public $fecha;
    public $metodo_pago;
    public $descripcion;
    public $servicios = [];
    public $servicio_id;
    public $cantidad = 1;
    public $ivaInput = 21; // porcentaje por defecto
    public $facturaId;
    public $titulo = 'Crear Factura';
    public $recibosAsignados = [];
    public $recibosDisponibles = [];
    public $montoAsignado = 0;
    public $recibo_id;
    public $recibosAsignadosTemporal = []; // Almacena IDs de recibos


    public function updatedServicioId($servicioId)
    {
        $servicio = Servicio::find($servicioId); // Busca el servicio seleccionado

        if ($servicio) {
            $this->ivaInput = $servicio->iva * 100; // Actualiza el IVA del servicio seleccionado
        } else {
            $this->ivaInput = 0; // Resetea el valor de IVA si no hay servicio seleccionado
        }
    }

    public function mount($facturaId = null)
    {
        $this->clinica = Auth::user()->clinica;
        $this->fecha = now()->format('Y-m-d');
        $this->recibosDisponibles = \App\Models\Recibo::where('paciente_id', $this->paciente_id)
            ->whereDoesntHave('facturas') // Solo recibos no asignados
            ->get();

        if ($facturaId) {
            $this->facturaId = $facturaId;
            $factura = Factura::with('detalles')->findOrFail($facturaId);

            $this->paciente_id = $factura->paciente_id;
            $this->fecha = $factura->fecha;
            $this->metodo_pago = $factura->metodo_pago;
            $this->descripcion = $factura->descripcion;

            $this->servicios = $factura->detalles->map(function ($item) {
                return [
                    'servicio_id' => $item->servicio_id,
                    'descripcion' => $item->descripcion,
                    'precio_unitario' => $item->precio_unitario,
                    'cantidad' => $item->cantidad,
                    'iva' => $item->iva,
                    'iva_porcentaje' => $item->iva_porcentaje,
                    'subtotal' => $item->subtotal,
                    'total' => $item->total,
                ];
            })->toArray();
        }
    }

    public function updatedReciboId($value)
    {
        if ($value) {
            $recibo = \App\Models\Recibo::find($value);
            if ($recibo) {
                $totalFactura = $this->calcularTotal();
                $this->montoAsignado = $recibo->valor;
                if ($recibo->valor < $totalFactura) {
                    session()->flash('error', 'El monto de la factura excede el valor del recibo seleccionado.');
                } elseif ($recibo->valor >= $totalFactura) {
                    session()->flash('success', 'La factura ya está cubierta por el recibo seleccionado.');
                }
            }
        } else {
            $this->montoAsignado = 0;
        }
    }
    /**
     * Agrega un servicio a la factura.
     * Calcula el subtotal, IVA y total del servicio.
     */
    public function addServicio()
    {

        $servicio = Servicio::find($this->servicio_id);

        if (!$servicio) return;

        $ivaRate = $this->ivaInput / 100;
        $subtotal = $servicio->precio * $this->cantidad;
        $totalIva = $subtotal * $ivaRate;
        $total = $subtotal + $totalIva;

        $this->servicios[] = [
            'servicio_id' => $servicio->id,
            'descripcion' => $servicio->nombre,
            'precio_unitario' => $servicio->precio,
            'cantidad' => $this->cantidad,
            'iva' => $totalIva,
            'iva_porcentaje' => $this->ivaInput,
            'subtotal' => $subtotal,
            'total' => $total,
        ];

        $this->servicio_id = null;
        $this->cantidad = 1;
        $this->ivaInput = 21;
    }

    public function removeServicio($index)
    {
        unset($this->servicios[$index]);
        $this->servicios = array_values($this->servicios);
    }

    public function calcularTotal()
    {
        return collect($this->servicios)->sum('total');
    }

    public function save()
    {
        $this->authorize('create facturas');
        $this->validate([
            'paciente_id' => 'required',
            'fecha' => 'required|date',
            'metodo_pago' => 'required|in:efectivo,tarjeta',
        ]);

        DB::beginTransaction();

        try {
            if ($this->facturaId) {
                $factura = Factura::findOrFail($this->facturaId);

                $factura->update([
                    'paciente_id' => $this->paciente_id,
                    'fecha' => $this->fecha,
                    'metodo_pago' => $this->metodo_pago,
                    'descripcion' => $this->descripcion,
                    'total' => $this->calcularTotal(),
                ]);
                $factura->detalles()->delete(); // Reemplazar detalles
                // Quitar recibos anteriores y asignar los nuevos

            } else {
                $factura = Factura::create([
                    'clinica_id' => $this->clinica->id,
                    'paciente_id' => $this->paciente_id,
                    'fecha' => $this->fecha,
                    'estado' => 'pendiente',
                    'metodo_pago' => $this->metodo_pago,
                    'descripcion' => $this->descripcion,
                    'total' => $this->calcularTotal(),
                ]);
                // Asignar recibo a la factura (si corresponde)
                // 3. Asignar los recibos (solo si hay)
                if (!empty($this->recibosAsignadosTemporal)) {
                    $pivotData = [];
                    foreach ($this->recibosAsignadosTemporal as $reciboId) {
                        $recibo = \App\Models\Recibo::find($reciboId);
                        if ($recibo) {
                            $pivotData[$reciboId] = ['valor' => $recibo->valor];
                        }
                    }
                    $factura->recibos()->attach($pivotData);
                }
            }

            foreach ($this->servicios as $item) {
                FacturaDetalle::create([
                    'factura_id' => $factura->id,
                    ...$item
                ]);
            }

            DB::commit();
            if ($this->facturaId) {
                session()->flash('success', 'Factura actualizada correctamente.');
                return redirect()->route('facturas.index');
            } else {
                $this->reset([
                    'paciente_id',
                    'metodo_pago',
                    'descripcion',
                    'servicios',
                    'servicio_id',
                    'cantidad',
                    'ivaInput'
                ]);

                return $this->download($factura->id); // 🔁 ahora hace todo desde aquí
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al generar factura: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        $factura = Factura::with(['paciente', 'clinica', 'detalles'])->findOrFail($id);

        // 👇 Generar el QR aquí
        $factura->load(['paciente', 'clinica', 'detalles']);
        $qrData = json_encode([
            'factura' => $factura->numero_factura,
            'fecha' => $factura->fecha,
            'total' => $factura->total,
        ]);
        $qrSvg = base64_encode(QrCode::format('svg')->size(120)->generate($qrData));

        // 👇 Cargar la vista pasando el QR
        $pdf = Pdf::loadView('pdf.factura', [
            'factura' => $factura,
            'qrSvg' => $qrSvg,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'factura_' . $factura->numero_factura . '.pdf');
    }

    public function updatedPacienteId($value)
    {
        $this->recibosDisponibles = \App\Models\Recibo::where('paciente_id', $value)
            ->whereDoesntHave('facturas')
            ->get();
        $this->recibo_id = null; // Resetea el recibo seleccionado si cambias de paciente
    }

    public function render()
    {
        $this->authorize('create facturas');
        if ($this->paciente_id) {
            $this->recibosDisponibles = \App\Models\Recibo::where('paciente_id', $this->paciente_id)
                ->whereDoesntHave('facturas')
                ->get();
        } else {
            $this->recibosDisponibles = collect();
        }

        if ($this->facturaId) {
            $factura = Factura::with(['paciente', 'clinica', 'detalles'])->findOrFail($this->facturaId);
            $this->titulo = 'Actualizar Factura - ' . $factura->numero_factura;
        } else {
            $this->titulo = 'Crear Factura';
        }
        return view('livewire.facturas.factura-create', [
            'pacientes' => Paciente::where('clinica_id', $this->clinica->id)->orderby('apellido')->get(),
            'serviciosDisponibles' => Servicio::where('clinica_id', $this->clinica->id)
                ->where('estado', 'activo')->get(),
            'recibosDisponibles' => $this->recibosDisponibles,
        ]);
    }
    // Para actualizar una línea cuando se modifican sus valores
    public function actualizarLinea($index)
    {
        $linea = $this->servicios[$index];

        $subtotal = $linea['cantidad'] * $linea['precio_unitario'];
        $iva = $subtotal * ($linea['iva_porcentaje'] / 100);
        $total = $subtotal + $iva;

        $this->servicios[$index] = [
            ...$linea,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total
        ];
    }



    // Para generar el resumen de IVA
    public function getResumenIvaProperty()
    {
        $grupos = collect($this->servicios)->groupBy('iva_porcentaje');

        return $grupos->map(function ($items, $iva) {
            $base = $items->sum('subtotal');
            $importe = $items->sum('iva');

            return [
                'porcentaje' => $iva,
                'base' => $base,
                'importe' => $importe
            ];
        })->values()->toArray();
    }



    // Propiedad computada para el total de IVA
    public function getTotalIvaProperty()
    {
        return collect($this->servicios)->sum('iva');
    }

    // Propiedad computada para la base imponible
    public function getBaseImponibleProperty()
    {
        return collect($this->servicios)->sum(function ($item) {
            return $item['cantidad'] * $item['precio_unitario'];
        });
    }

    // Método para agregar recibo temporalmente
    public function agregarRecibo($reciboId)
    {
        if (!in_array($reciboId, $this->recibosAsignadosTemporal)) {
            $this->recibosAsignadosTemporal[] = $reciboId;
            $this->actualizarMontoAsignado();
        }
    }

    // Método para quitar recibo temporal
    public function quitarRecibo($reciboId)
    {
        $this->recibosAsignadosTemporal = array_diff($this->recibosAsignadosTemporal, [$reciboId]);
        $this->actualizarMontoAsignado();
    }

    // Método para calcular el monto asignado temporal
    public function getMontoAsignadoTemporalProperty()
    {
        if (empty($this->recibosAsignadosTemporal)) return 0;

        return Recibo::whereIn('id', $this->recibosAsignadosTemporal)
            ->sum('valor');
    }
    public function actualizarMontoAsignado()
    {
        $this->montoAsignado = \App\Models\Recibo::whereIn('id', $this->recibosAsignadosTemporal)->sum('valor');
    }
}
