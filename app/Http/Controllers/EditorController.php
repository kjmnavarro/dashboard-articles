<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EditorController extends Controller
{
    public function index()
    {
        $forEditArticles = Article::with(['writer', 'editor'])
            ->where('status', 'For Edit')
            ->get();

        $publishedArticles = Article::with(['writer', 'editor'])
            ->where('status', 'Published')
            ->get();

        return view('editors.index', compact('forEditArticles', 'publishedArticles'));
    }

    public function allMedia()
    {
        $articles = Article::with('writer', 'editor')->get();

        return view('editors.allmedia', compact('articles'));
    }

    public function edit($encryptedId)
    {
        $article = Crypt::decrypt($encryptedId);
        $this->authorize('edit-articles', $article);
        $companies = Company::all();
        return view('editors.edit', compact('article', 'companies'));
    }

    public function update(Request $request, $encryptedId)
    {
        $article = Crypt::decrypt($encryptedId);
        $this->authorize('edit-articles', $article);
        
        $request->validate([
            'image' => 'required|url',
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:For Edit,Published',
        ]);

        if ($request->action === 'publish') {
            $request->status = 'Published';
        }

        $article->update([
            'image' => $request->image,
            'title' => $request->title,
            'link' => $request->link,
            'date' => $request->date,
            'content' => strip_tags($request->content),
            'status' => $request->status,
            'editor_id' => Auth::id(),
        ]);

        return redirect()->route('editors.allMedia')->with('success', 'Article updated successfully!');
    }
}
