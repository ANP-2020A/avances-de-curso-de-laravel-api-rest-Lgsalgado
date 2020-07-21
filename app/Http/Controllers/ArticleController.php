<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use phpDocumentor\Reflection\Types\Self_;

class ArticleController extends Controller
{
    private static $rules=[
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required',
        ];
    private static $messages=[
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'El body no es válido.'
    ];
    public function index()
    {
        return new ArticleCollection(Article::paginate());
    }
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article),200);
    }
    public function store(Request $request)
    {
        $request->validate(self::$rules, self::$messages);
//        $messages = [
//            'required' => 'El campo :attribute es obligatorio.',
//            'body.required' => 'El body no es válido.'
//        ];
//        $validatedData = $request->validate([
//            'title' => 'required|string|unique:articles|max:255',
//            'body' => 'required',
//        ], $messages);

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }
    public function update(Request $request, Article $article)
    {

        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Request $request, Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
