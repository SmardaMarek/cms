<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content', 'main_image', 'perex'];

    public function publish($new)
    {
        $new->published_at = now();
        $new->save();
    }

}
