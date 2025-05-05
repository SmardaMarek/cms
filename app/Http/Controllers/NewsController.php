<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Services\NewsService;
use Illuminate\Support\Arr;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }


    public function store(NewsRequest $request, NewsService $newsService)
    {
        $data = $request->validated();

        $new = News::create(Arr::except($data, ['gallery_images', 'main_image']));

        if ($request->hasFile('main_image')) {
            $pathToMainImage = $newsService->handleUploadedMainImage($request->file('main_image'), $new);
            $new->update(['main_image' => $pathToMainImage]);
        }

        if ($request->hasFile('gallery_images')) {
            $pathToMainImages = $newsService->handleUploadedImages($request->file('gallery_images'), $new);
            foreach ($pathToMainImages as $path) {
                $new->images()->create(['path' => $path]);
            }
        }

        session()->flash('message', 'Aktualita úspěšně vytvořena.');
        return redirect()->route('news');
    }

    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('admin.news.show', compact('new'));
    }

    public function edit($id)
    {
        $new = News::findOrFail($id);
        return view('admin.news.edit', compact('new'));
    }

    public function update(NewsRequest $request, NewsService $newsService, $id)
    {
        $data = $request->validated();
        $new = News::findOrFail($id);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $newsService->handleUploadedMainImage($request->file('main_image'), $new);
        }

        if ($request->hasFile('gallery_images')) {
            $pathToMainImages = $newsService->handleUploadedImages($request->file('gallery_images'), $new);
            foreach ($pathToMainImages as $path) {
                $new->images()->create(['path' => $path]);
            }
        }

        $new->update($data);

        session()->flash('message', 'Aktualita úspěšně upravena.');

        return redirect()->route('news.show', $new->id);
    }
    public function delete($id)
    {

        $new = News::findOrFail($id);
        $new->deleteImages();

        $new->delete();
        session()->flash('message', 'Aktualita úspěšně smazána.');
        return redirect()->route('news');
    }

    public function publish($id)
    {
        $new = News::findOrFail($id);
        $new->publish();

        session()->flash('message', 'Aktualita úspěšně vydána.');
        return redirect()->route('news.show', $new->id);
    }

    public function deleteImage($id)
    {
        $image = NewsImage::findOrFail($id);
        Storage::disk('public')->delete($image->path);

        $image->delete();

        return back()->with('message', 'Obrázek byl smazán.');
    }

}
