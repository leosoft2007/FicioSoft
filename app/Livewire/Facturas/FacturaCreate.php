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

    public function mount()
        {
            $this->clinica = Auth::user()->clinica; // Asume relación User->clinica
            $this->fecha = now()->format('Y-m-d');
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
    
            foreach ($this->servicios as $item) {
                FacturaDetalle::create([
                    'factura_id' => $factura->id,
                    ...$item
                ]);
            }
    
            DB::commit();
    
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
    
            // Resetear los campos del formulario
            $this->reset(['paciente_id', 'metodo_pago', 'descripcion', 'servicios', 'servicio_id', 'cantidad', 'ivaInput']);
    
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'factura_' . $factura->numero_factura . '.pdf');
    
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al generar factura: ' . $e->getMessage());
        }
    }

        public function download($id)
            {
                $factura = Factura::with(['paciente', 'clinica', 'detalles'])->findOrFail($id);

                // Prepara el texto del QR, por ejemplo JSON o URL
                $qrData = json_encode([
                    'factura' => $factura->numero_factura,
                    'fecha'   => $factura->fecha,
                    'total'   => $factura->total,
                ]);

                // Genera el SVG


                
                $qrImage = QrCode::format('png')->size(150)->generate($qrData);
                $qrBase64 = base64_encode($qrImage);

               // 👇 Aquí estás pasando $qrSvg junto con $factura a la vista
               $pdf = Pdf::loadView('pdf.factura', [
                'factura' => $factura,
                'qrBase64' => $qrBase64,
            ]);

                return $pdf->download("factura_{$factura->numero_factura}.pdf");
            }

        public function render()
        {
            return view('livewire.facturas.factura-create', [
                'pacientes' => Paciente::where('clinica_id', $this->clinica->id)->get(),
                'serviciosDisponibles' => Servicio::where('clinica_id', $this->clinica->id)
                    ->where('estado', 'activo')->get(),
            ]);
        }

        
    }