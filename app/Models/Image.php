<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    protected $fillable = ['filename', 'mime_type', 'data'];

    /**
     * Relación polimórfica: la imagen puede pertenecer a cualquier modelo.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    public static function storeOrUpdateFromUpload(UploadedFile $file, Model $model, int $width = 300, string $format = 'png'): self
    {
        // Redimensionar la imagen
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->scale(width: $width)->encode($format);

        // Si ya tiene imagen asociada, la reemplazamos
        if ($model->image) {
            $model->image->update([
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'data' => $image->toString(),
            ]);

            return $model->image;
        }

        // Si no, la creamos
        return self::create([
            'filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'data' => $image->toString(),
            'imageable_id' => $model->id,
            'imageable_type' => get_class($model),
        ]);
    }

    /**
     * Elimina la imagen asociada a un modelo.
     */
    public static function deleteFromModel(Model $model): bool
    {
        if ($model->image) {
            return $model->image->delete();
        }

        return false;
    }
}
