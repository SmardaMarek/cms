<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['title', 'content', 'main_image', 'perex'];

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }

    public function publish()
    {
        $this->published_at = now();
        $this->save();
    }

    public function deleteImages()
    {
        foreach ($this->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        Storage::disk('public')->deleteDirectory("aktuality/hlavni-obrazek/{$this->id}");
        Storage::disk('public')->deleteDirectory("aktuality/galerie/{$this->id}");
    }

}
