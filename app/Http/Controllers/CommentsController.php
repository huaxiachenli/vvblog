<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * CommentsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $comment = new Comment();
        $article =Article::findOrFail($request->input('article_id'));
        $comment->fill([
            'user_id'=>Auth::user()->id,
            'article_id'=>$request->input('article_id'),
            'content'=>$request->input('content'),
            'parent_id'=>$request->input('parent_id'),
            'floor'=>$article->comments->count()+1,
        ]);
        $comment->save();
        return response()->json(['status'=>0,'commentId'=>$comment->id,'content'=>Markdown::convertToHtml($comment->content),'createdAt'=>$comment->created_at->toDateTimeString(),'floor'=>$comment->floor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::findOrFail($id)->delete();
        if ($comment){
            return response()->json(['status'=>0]);
        }
    }
}
