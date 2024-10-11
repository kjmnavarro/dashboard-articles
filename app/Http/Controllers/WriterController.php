<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WriterController extends Controller
{
    public function index()
    {
        $forEditArticles = Article::with(['writer', 'editor'])
            ->where('status', 'For Edit')
            ->get();

        $publishedArticles = Article::with(['writer', 'editor'])
            ->where('status', 'Published')
            ->get();

        return view('writers.index', compact('forEditArticles', 'publishedArticles'));
    }

    public function allMedia()
    {
        $articles = Article::with('writer', 'editor')->get();

        return view('writers.allmedia', compact('articles'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('writers.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|url',
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required|string',
        ]);

        Article::create([
            'image' => $request->image,
            'title' => $request->title,
            'link' => $request->link,
            'date' => $request->date,
            'content' => strip_tags($request->content),
            'status' => 'For Edit',
            'writer_id' => Auth::id(),
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('writers.index')->with('success', 'Article created successfully!');
    }

    public function edit($encryptedId)
    {
        $article = Crypt::decrypt($encryptedId);
        $this->authorize('update-articles', $article);
        $companies = Company::all();
        return view('writers.edit', compact('article', 'companies'));
    }

    public function update(Request $request, $encryptedId)
    {
        $article = Crypt::decrypt($encryptedId);
        $this->authorize('update-articles', $article);
        
        $request->validate([
            'image' => 'required|url',
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:For Edit,Published',
        ]);

        $article->update([
            'image' => $request->image,
            'title' => $request->title,
            'link' => $request->link,
            'date' => $request->date,
            'content' => strip_tags($request->content),
            'status' => $request->status,
            'editor_id' => Auth::id(),
        ]);

        return redirect()->route('writers.allMedia')->with('success', 'Article updated successfully!');
    }
}
