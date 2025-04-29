<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'perex' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('aktuality', 'public');
        }

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

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'perex' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
        ]);
        $new = News::findOrFail($id);
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

    //TODO: add upload images and galery

}
