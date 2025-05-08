<?php
namespace App\Repositories;

use App\Models\NewsImage;
use Illuminate\Support\Facades\Storage;

class NewsImageRepository implements NewsImageRepositoryInterface
{

    public function delete(int $id): bool
    {
        $image = NewsImage::findOrFail($id);
        Storage::disk('public')->delete($image->path);

        return $image->delete();
    }

    public function find(int $id): ?NewsImage
    {
        return NewsImage::find($id);
    }

}