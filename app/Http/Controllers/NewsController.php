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
            'main_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('aktuality', 'public');
        }

        News::create($data);

        return redirect()->route('news')->with('success', 'Aktualita vytvořena.');
    }

    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('news.show', compact('new'));
    }

    public function delete($id)
    {

        $new = News::findOrFail($id);
        $new->delete();

        return redirect()->route('news')->with('success', 'Aktualita smazána.');
    }

}
