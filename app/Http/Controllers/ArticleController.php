<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\articleResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * OPEN ROUTE
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function published(Request $request)
    {
        $take = $request->has('take') ? $request->input('take') : 10;

        return Article::with('user:id,name')->published()->paginate($take);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function load()
    {
        //@todo Create policy for authorization
        $auth_user = Auth::user();

        if(!$auth_user->role == 1) {
            $article = Article::with('user:id,name')->get();
        } else {
            $article = Article::with('user:id,name')->where('user_id', $auth_user->id)->get();
        }

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

    public function show( $article_id)
    {
        //@todo Create policy for authorization to se not published articles only for admins

//        $article = Article::find($article_id)->with('user:id,name')->published()->first();
        $article = Article::find($article_id)->with('user:id,name')->first();

        return response()->json($article);
    }

    public function update(Article $article, ArticleUpdateRequest $request)
    {
        //@todo Create policy for authorization

        $article->tags = $request->input('tags');
        $article->title = $request->input('title');
        $article->content = $request->input('content');

        $article->featured = $request->input('featured');
        $article->status = $request->input('status');

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
