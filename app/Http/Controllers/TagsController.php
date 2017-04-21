<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    //
    public function show($user_id,$tag)
    {
       $user = User::find($user_id);
        $articles = $user->tags()->where('name',$tag)->first()->articles()->paginate();
        return view('tags.show')->with(['articles'=>$articles,'user'=>$user]);
    }
}
