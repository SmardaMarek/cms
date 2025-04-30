<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Services\NewsService;

class NewsController extends Controller
{

    //TODO: add upload images and galery

    //TODO edit routing? 

    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }


    public function store(NewsRequest $request, NewsService $newsService)
    {
        $data = $request->validated();

        $data['main_image'] = $newsService->handleUploadedImage($request->file('main_image'));

        News::create($data);
        session()->flash('message', 'Aktualita úspěšně vytvořena.');
        return redirect()->route('news');
    }

    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('news.show', compact('new'));
    }

    public function edit($id)
    {
        $new = News::findOrFail($id);
        return view('news.edit', compact('new'));
    }

    public function update(NewsRequest $request, NewsService $newsService, $id)
    {
        $data = $request->validated();
        $new = News::findOrFail($id);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $newsService->handleUploadedImage($request->file('main_image'));
        }
        $new->update($data);

        session()->flash('message', 'Aktualita úspěšně upravena.');

        return redirect()->route('news.show', $new->id);
    }
    public function delete($id)
    {

        $new = News::findOrFail($id);
        $new->delete();
        session()->flash('message', 'Aktualita úspěšně smazána.');
        return redirect()->route('news');
    }

    public function publish($id)
    {
        $new = News::findOrFail($id);
        $new->published_at = now();
        $new->save();
        session()->flash('message', 'Aktualita úspěšně vydána.');
        return redirect()->route('news.show', $new->id);
    }

}
