<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller implements HasMiddleware
{


    public static function middleware()
    {
        return [
            new Middleware('permission:view articles',only:['index']),
            new Middleware('permission:edit articles',only:['edit']),
            new Middleware('permission:create articles',only:['create']),
            new Middleware('permission:delete articles',only:['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:10',
                'author' => 'required|min:10',
            ]
        );

        if ($validator->passes()) {
            $article = new Article();
            $article->title = $request->title;
            $article->text = $request->text;
            $article->auther = $request->author;
            $article->save();

            return redirect()->route('article.index')->with('success', 'Article added successfully.');
        } else {
            return redirect()->route('article.create')->withInput()->withErrors($validator);
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:10',
                'author' => 'required|min:10',
            ]
        );

        if ($validator->passes()) {
            $article->title = $request->title;
            $article->text = $request->text;
            $article->auther = $request->author;
            $article->save();

            return redirect()->route('article.index')->with('success', 'Article Updated successfully.');
        } else {
            return redirect()->route('article.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $article = Article::find($id);

        if ($article == null) {
            session()->flash('error', 'Article not found');
            return response()->json([
                'status' => false
            ]);
        }

        $article->delete();
        session()->flash('success', 'Article deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
