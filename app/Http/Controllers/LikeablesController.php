<?php

namespace App\Http\Controllers;

use App\Likeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeablesController extends Controller
{
    /**
     * LikeablesController constructor.
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
        $likeable = new Likeable();
        $likeable->fill([
           'article_id'=>$request->input('article_id'),
            'user_id'=>Auth::user()->id,
        ]);
        $likeable->save();
        $like_count = Likeable::where('article_id',$request->input('article_id'))->count();

        return response()->json(['status'=>0,'likeableId'=>$likeable->id,'likeCount'=>$like_count]);

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
    public function destroy(Request $request,$id)
    {
        //

        $likeable = Likeable::findOrFail($id)->delete();
        $like_count = Likeable::where('article_id',$request->input('article_id'))->count();
        if($likeable){
            return response()->json(['status'=>0,'likeCount'=>$like_count],200);
        }else{
            return response()->json(['status'=>1,'likeCount'=>$like_count],200);
        }
    }
}
