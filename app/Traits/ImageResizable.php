<?php

namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

trait ImageResizable
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager();
    }

    /**
     * Redimensiona y guarda la imagen en disco.
     *
     * @param \Illuminate\Http\UploadedFile|string $imageFile Archivo o path
     * @param string $folder Carpeta donde guardar (ejemplo 'pacientes')
     * @param int $width Ancho máximo (mantiene aspect ratio)
     * @param string $disk Disco Laravel (ej: 'public')
     * @return string Ruta relativa donde se guardó la imagen
     */
    public function resizeAndSave($imageFile, string $folder, int $width = 300, string $disk = 'public'): string
    {
        $image = is_string($imageFile)
            ? $this->imageManager->make($imageFile)
            : $this->imageManager->make($imageFile->getRealPath());

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $filename = uniqid() . '.' . ($imageFile instanceof \Illuminate\Http\UploadedFile
            ? $imageFile->getClientOriginalExtension()
            : pathinfo($imageFile, PATHINFO_EXTENSION) ?? 'jpg');

        $path = $folder . '/' . $filename;

        // Guardar imagen en disco configurado en Laravel
        Storage::disk($disk)->put($path, (string) $image->encode());

        return $path; // Ruta relativa para guardar en DB
    }

    /**
     * Redimensiona y devuelve la imagen como string binario.
     *
     * @param \Illuminate\Http\UploadedFile|string $imageFile Archivo o path
     * @param int $width Ancho máximo (mantiene aspect ratio)
     * @param string $format Formato de imagen (png, jpg...)
     * @return string Imagen en formato binario lista para guardar en DB (BYTEA)
     */
    public function resizeToBinary($imageFile, int $width = 300, string $format = 'png'): string
    {
        $image = is_string($imageFile)
            ? $this->imageManager->make($imageFile)
            : $this->imageManager->make($imageFile->getRealPath());

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return (string) $image->encode($format);
    }
}
