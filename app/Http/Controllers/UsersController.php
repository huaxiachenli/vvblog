<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['edit','update','store','dashboard']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return view('users.index')->with(['users'=>$user]);
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
        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')){
            $filename = $request->file('avatar')->getClientOriginalName();

            $path = $request->file('avatar')->move('avatar/',$filename)->getPathname();
             Image::make(public_path('avatar/'.$filename))->resize(200,200)->save(public_path('smallavatar/'.$filename));

        }else{
            $path=null;
        }
        $user->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'logo'=>$path
        ]);
        \Session::flash('success','信息修改成功！');
        return redirect()->route('dashboard',Auth::user()->id);
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
    public function dashboard(Request $request,$id)
    {
        $user = User::findOrFail($id);
        return view('users.dashboard')->with('user',$user);
    }
}
