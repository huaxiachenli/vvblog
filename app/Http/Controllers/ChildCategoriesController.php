<?php

namespace App\Http\Controllers;

use App\ChildCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChildCategoriesController extends Controller
{
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
                    'category_id'=>$request->input('parent_id')
                ]);
                $child_category->save();

            return response()->json(['name'=>$child_category->name,'id'=>$child_category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$id)
    {
        //
        $child_category = ChildCategory::findOrFail($id);
        $articles = ChildCategory::findOrFail($id)->articles()->paginate(5);
        $user = User::findOrFail($user_id);

        return view('child_categories.show')->with(['articles'=>$articles,'user'=>$user,'child_category'=>$child_category]);

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
    public function destroy($user_id,$id)
    {
        //
        ChildCategory::findOrFail($id)->delete();
        return response()->json(['status'=>0]);

    }
}
