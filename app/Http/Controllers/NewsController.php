<?php

namespace App\Http\Controllers;


use App\Http\Requests\NewsRequest;
use App\Services\NewsService;
use App\Services\NewsImageService;

class NewsController extends Controller
{
    public function __construct(protected NewsService $newsService, protected NewsImageService $newsImageService)
    {
    }

    public function index()
    {
        $news = $this->newsService->findLatest();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }


    public function store(NewsRequest $request)
    {
        $data = $request->validated();

        $this->newsService->create($data, $request->file('main_image'), $request->file('gallery_images'));

        session()->flash('message', 'Aktualita úspěšně vytvořena.');
        return redirect()->route('news');
    }

    public function show($id)
    {
        $new = $this->newsService->find($id);
        return view('admin.news.show', compact('new'));
    }

    public function edit($id)
    {
        $new = $this->newsService->find($id);
        return view('admin.news.edit', compact('new'));
    }

    public function update(NewsRequest $request, $id)
    {
        $data = $request->validated();
        $this->newsService->update($data, $id, $request->file('main_image'), $request->file('gallery_images'));

        session()->flash('message', 'Aktualita úspěšně upravena.');

        return redirect()->route('news.show', $id);
    }
    public function delete($id)
    {

        $this->newsService->delete($id);
        session()->flash('message', 'Aktualita úspěšně smazána.');
        return redirect()->route('news');
    }

    public function publish($id)
    {
        $new = $this->newsService->find($id);
        $new->publish();

        session()->flash('message', 'Aktualita úspěšně vydána.');
        return redirect()->route('news.show', $id);
    }

    public function deleteImage($id)
    {
        $this->newsImageService->delete($id);

        return back()->with('message', 'Obrázek byl smazán.');
    }

}
