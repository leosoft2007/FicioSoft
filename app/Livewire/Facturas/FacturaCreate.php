<?php

namespace App\Livewire\Facturas;

use Livewire\Component;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Models\Clinica;
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


    public function mount($facturaId = null)
{
    $this->clinica = Auth::user()->clinica;
    $this->fecha = now()->format('Y-m-d');

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
                } else {
                    $factura = Factura::create([
                        'clinica_id' => $this->clinica->id,
                        'paciente_id' => $this->paciente_id,
                        'fecha' => $this->fecha,
                        'estado' => 'pendiente',
                        'metodo_pago' => $this->metodo_pago,
                        'numero_factura' => strtoupper(Str::random(10)),
                        'descripcion' => $this->descripcion,
                        'total' => $this->calcularTotal(),
                    ]);
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
                'paciente_id', 'metodo_pago', 'descripcion',
                'servicios', 'servicio_id', 'cantidad', 'ivaInput'
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

        public function render()
        {
            if ($this->facturaId) {
                $factura = Factura::with(['paciente', 'clinica', 'detalles'])->findOrFail($this->facturaId);
                $this->titulo = 'Actualizar Factura - ' . $factura ->numero_factura;
            } else {
                $this->titulo = 'Crear Factura';
            }
            return view('livewire.facturas.factura-create', [
                'pacientes' => Paciente::where('clinica_id', $this->clinica->id)->orderby('apellido')->get(),
                'serviciosDisponibles' => Servicio::where('clinica_id', $this->clinica->id)
                    ->where('estado', 'activo')->get(),
            ]);
        }

        
    }