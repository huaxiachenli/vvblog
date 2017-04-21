<?php

namespace App\Http\Controllers\admin;

use App\user;
use App\ChildCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChildCategoriesController extends Controller
{
    /**
     * ChildCategoriesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['store','edit','update','destroy']]);
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
        $child_category = new ChildCategory();
        $child_category->fill([
            'user_id'=>Auth::user()->id,
            'name'=>$request->input('name'),
            'category_id'=>$request->input('category_id')
        ]);
        $child_category->save();

        return response()->json(['child_category'=>$child_category]);
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
        $child_category = Auth::user()->child_categories()->find($id);
        if($child_category->delete()){
            return response()->json(['status'=>0]);
        }
    }
}
