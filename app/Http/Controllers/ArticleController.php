<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function loadAll()
    {
        //@todo Create policy for authorization

        $article = Article::all();

        //@todo Include pagination

        return response()->json($article);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleStoreRequest $request)
    {
        //@todo Create policy for authorization

        $new_article = new Article();

        $new_article->user_id = Auth::user()->id;
        $new_article->tags = $request->input('tags');
        $new_article->title = $request->input('title');
        $new_article->content = $request->input('content');
        $new_article->status = $request->input('status');
        $new_article->featured = $request->input('featured');
        $new_article->position = $request->input('position');

        //upload Images and save
        $new_article->images = $request->input('images');

        $new_article->save();

        //@todo Dispatch event article created

        return response()->json($new_article, 201);
    }

    public function edit(Article $article)
    {
        //@todo Create policy for authorization

        return response()->json($article);
    }

    public function update(Article $article, ArticleUpdateRequest $request)
    {
        //@todo Create policy for authorization

        $article->tags = $request->input('tags');
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->featured = $request->input('featured');

        //upload Images and save
        $article->images = $request->input('images');

        $article->save();

        return response()->json($article);
    }

    public function manager(Article $article, ArticleUpdateRequest $request)
    {
        //@todo Create policy for authorization

        $article->status = $request->input('status');
        $article->position = $request->input('position');
        $article->featured = $request->input('featured');

        $article->save();

        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        //@todo Create policy for authorization

        $article->delete();

        //@todo Create log for deleted

        return response('deleted', 204);
    }

}
