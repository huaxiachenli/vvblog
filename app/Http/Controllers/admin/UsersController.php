<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class UsersController extends Controller
{
    /**
     * UsersController constructor.
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
        $user = Auth::user();
        return view('admin.users.index')->with(['user'=>$user]);
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
        $this->validate($request,[
       'name'=>'required|max:30',
       'email'=>'required|email',
       'logo'=>'mimes:jpeg,bmp,png,jpg',
       ]);
        $user = Auth::user();
        if ($request->hasFile('avatar')){
            $filename = $request->file('avatar')->getClientOriginalName();
            $origin_path =  $request->file('avatar')->move('avatar/',$filename)->getPathname();
            Image::make(public_path('avatar/'.$filename))->resize(200,200)->save(public_path('smallavatar/avatar/'.$filename));
            $path ='smallavatar/'. $origin_path;
        }else{
            $path=Auth::user()->logo;
        }
        $user->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'logo'=>$path
        ]);
        \Session::flash('success','信息修改成功！');
        return redirect('/home');
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
    }
}
