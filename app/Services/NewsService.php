<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function handleUploadedMainImage(?UploadedFile $image, $new): ?string
    {
        if ($image !== null) {
            return $image->store("aktuality/hlavni-obrazek/{$new->id}", 'public');
        }

        return null;
    }

    public function handleUploadedImages(?array $images, $new): ?array
    {
        $paths = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $paths[] = $image->store("aktuality/galerie/{$new->id}", 'public');
                }
            }
            return $paths;
        }
        return $paths;
    }
}