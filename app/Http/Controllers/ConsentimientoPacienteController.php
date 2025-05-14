<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsentimientoPaciente;
use App\Models\Consentimiento;
use App\Models\Paciente;
use App\Services\MetadataService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Laravel\Prompts\text;
use function Pest\Laravel\json;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConsentimientoPacienteController extends Controller
{
    public function index()
    {
        $firmas = ConsentimientoPaciente::latest()->get();
        return view('consentimiento_paciente.index', compact('firmas'));
    }
    public function firmar(Paciente $paciente, Consentimiento $consentimientos)
    {
        return view('consentimiento_paciente.index', compact('paciente', 'consentimientos'));
    }


    public function store(Request $request, Paciente  $paciente, Consentimiento $consentimiento, MetadataService $metadata)
    {
        $documentContent = $metadata->generateDocumentContent(
            $paciente->paciente_id,
            $request->fiirma,
        );

        $request->validate([
            'firma' => 'required|string',
            'firma_png' => 'sometimes|string'
        ]);

        // Procesar y guardar el PNG si está presente
        $pngPath = null;
        if ($request->has('firma_png') && !empty($request->firma_png)) {
            $pngData = $request->firma_png;

            // Extraer los datos base64
            $imageData = explode(',', $pngData)[1];
            $imageData = str_replace(' ', '+', $imageData);
            $decodedImage = base64_decode($imageData);


            // Generar nombre único para el archivo
            $fileName = 'firmas/firma.png';

            // Guardar el archivo en el storage público
            Storage::disk('public')->put($fileName, $decodedImage);

            // Obtener la ruta pública del archivo
            $pngPath = Storage::url($fileName);
        }
        //  dd($pngPath);


        // 👇 Generar el QR aquí

        $qrData = json_encode([
            'hash_documento' => json_encode($documentContent['hashes']),
            'dispositivo' => json_encode($documentContent['device']),

        ]);
        $qrSvg = base64_encode(QrCode::format('svg')->size(120)->generate($qrData));


        // Adjuntar con datos adicionales (firma)
        // $paciente->consentimientos()->attach($consentimiento->id,
        $registro = ConsentimientoPaciente::create([
            'paciente_id' => $paciente->id,
            'consentimiento_id' => $consentimiento->id,
            'firma' => $request->firma,
            'hash_documento' => json_encode($documentContent['hashes']),
            'dispositivo' => json_encode($documentContent['device']),
            'ip_firma' => $request->ip(),
            'firmado_en' => now()

        ]);
        $this->generarPdf($registro->id); // Guarda el PDF
        return redirect()->route('pacientes.show', $paciente->id)
            ->with('success', 'Consentimiento firmado correctamente. Puedes descargar el PDF firmado abajo.');





        // return redirect()->route('pacientes.show', $paciente->id)
        //     ->with('success', 'Consentimiento firmado correctamente.');


        //  return redirect()->route('pacientes.show', $paciente->id)
        //     ->with('success', 'Consentimiento firmado correctamente.');
    }
    public function descargapdf($consentimientoId, $pacienteId)
    {
        
        $registro = ConsentimientoPaciente::with(['paciente', 'consentimiento'])
            ->where('consentimiento_id', $consentimientoId)
            ->where('paciente_id', $pacienteId)
            ->firstOrFail();

        $qrData = json_encode([
            'hash_documento' => json_encode($registro->hash_documento),
            'dispositivo' => json_encode($registro->dispositivo),

        ]);
        $qrSvg = base64_encode(QrCode::format('svg')->size(120)->generate($qrData));
        // return View('consentimiento_paciente.pdf',[
        // $pdf = Pdf::loadView('consentimiento_paciente.pdf',[
        $pdf = Pdf::loadView('consentimiento_paciente.pdf', [
            'contenido' => $registro->consentimiento->contenido,
            'firma' => $registro->firma,
            'dispositivo' => $registro->dispositivo,
            'fecha' => $registro->firmado_en->format('d/m/Y H:i'),
            'paciente' => $registro->paciente->nombre,
            'documento_hash' => $registro->hash_documento,
            'apellido' => $registro->paciente->apellido,
            'dni' => $registro->paciente->dni,
            'email' => $registro->paciente->email,
            'id' => $registro->id,
            'qrSvg' => $qrSvg,

        ]);

        return $pdf->download("consentimiento-{$registro->id}.pdf");
    }

    public function generarPdf($consentimientoId)
    {


        $registro = ConsentimientoPaciente::with(['paciente', 'consentimiento'])
            ->findOrFail($consentimientoId);

        $qrData = json_encode([
            'hash_documento' => json_encode($registro->hash_documento),
            'dispositivo' => json_encode($registro->dispositivo),

        ]);
        $qrSvg = base64_encode(QrCode::format('svg')->size(120)->generate($qrData));
        // return View('consentimiento_paciente.pdf',[
        // $pdf = Pdf::loadView('consentimiento_paciente.pdf',[
        $pdf = Pdf::loadView('consentimiento_paciente.pdf', [
            'contenido' => $registro->consentimiento->contenido,
            'firma' => $registro->firma,
            'dispositivo' => $registro->dispositivo,
            'fecha' => $registro->firmado_en->format('d/m/Y H:i'),
            'paciente' => $registro->paciente->nombre,
            'documento_hash' => $registro->hash_documento,
            'apellido' => $registro->paciente->apellido,
            'dni' => $registro->paciente->dni,
            'email' => $registro->paciente->email,
            'id' => $registro->id,
            'qrSvg' => $qrSvg,

        ]);

        return $pdf->download("consentimiento-{$registro->id}.pdf");
    }
}
