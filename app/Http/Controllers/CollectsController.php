<?php

namespace App\Http\Controllers;

use App\Collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CollectsController extends Controller
{
    /**
     * CollectsController constructor.
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
     * Store a newly created resource in storage.
     *
     * @param $article_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->ajax()){
            $collect = new Collect();
            $collect->fill([
                'user_id'=> Auth::user()->id,
                'article_id'=>$request->input('article_id'),
            ]);
            if ($collect->save()){
                return response()->json(['data'=>['id'=>$collect->id],'status'=>0],200);
            }
        }

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
        $collect = Collect::findOrFail($id)->delete();
        if ($collect){
            return response()->json(['status'=>0],200);
        }else{
            return response()->json(['status'=>1],200);
        }
    }
}
