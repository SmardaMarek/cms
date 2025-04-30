<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function handleUploadedImage(?UploadedFile $image): ?string
    {
        if ($image !== null) {
            return $image->store('aktuality', 'public');
        }

        return null;
    }
}