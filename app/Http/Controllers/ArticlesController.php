<?php

namespace App\Http\Controllers;

use App\Article;
use App\ChildCategory;
use App\Category;
use App\Picture;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{

    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['create','store','update','edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //


        $user = User::findOrfail($user_id);
        $articles = $user->articles->reverse();
        return view('articles.index')->with(['articles'=>$articles,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        //
        $user = User::findOrFail($user_id);
        $categories = $user->categories;
        return view('articles.create')->with(['user'=>$user,'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $user_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id)
    {
        //

        $user = User::findOrFail($user_id);
        $child_category = ChildCategory::findOrFail($request->input('child_category_id'));

        $article = new Article();

        $article->fill([
            'user_id'=>Auth::user()->id,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'category_id'=>$child_category->category->id,
            'child_category_id'=>$child_category->id,
            'intro'=>$request->input('intro'),
        ]);
        if ($article->save()){
            $tags = explode(',',$request->input('tag'));
            foreach ($tags as $tag){
                Tag::create([
                    'user_id'=>Auth::user()->id,
                    'article_id'=>$article->id,
                    'name'=>$tag,

                ]);
            }
            if ($request->hasFile('logo')){
                $filename = $request->file('logo')->getClientOriginalName();
                $path = $request->file('logo')->move('uploads/logos/',$article->id.$filename);
                $picture = new Picture();
                $picture->fill([
                    'user_id'=>Auth::user()->id,
                    'name'=>'articleLogo',
                    'pictureable_id'=>$article->id,
                    'pictureable_type'=>Article::class,
                    'field'=>'logo',
                    'url'=>$path,
                ]);
                $picture->save();
            }
            \Session::flash('success','保存成功');
            return redirect()->route('articles.show',[$article->user_id,$article->id])->with(['user'=>$user]);
        }else{
            \Session::flash('danger','保存失败');
            return redirect()->route('articles.create')->with('user',$user);
        }
    }

    /**
     * Display the specified resource.
     * @param int $user_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$id)
    {
        $user = User::findOrFail($user_id);
        $article = Article::findOrFail($id);
        $article->view_count=$article->view_count+1;
        $article->save();
        return view('articles.show')->with(['article'=>$article,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$id)
    {
        $user = User::findOrFail($user_id);
        //
        $article = Article::find($id);

        return view('articles.edit')->with(['article'=>$article,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id, $id)
    {

        //
        $user = User::findOrFail($user_id);
        $article = Article::find($id);
        $article->update([
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'intro'=>$request->input('intro'),
        ]);
        \Session::flash('success','保存成功');
        return redirect()->route('articles.show',$id)->with(['user'=>$user,'article'=>$article]);
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
        Article::findOrFail($id)->delete();
        return response()->json(['status'=>0]);
    }

    public function support($article_id){
        $article = Article::findOrFail($article_id);
        $article->suport_count=$article->suport_count+1;
        $article->save();
        return response()->json(['supportCount'=>$article->suport_count]);
    }

    public function unsupport($article_id){
        $article = Article::findOrFail($article_id);
        $article->reject_count=$article->reject_count+1;
        $article->save();
        return response()->json(['unsupportCount'=>$article->reject_count]);
    }

    public function category($user_id,$category_id){
        $category = Category::findOrFail($category_id);
        $articles = $category->articles;
        $user = User::findOrFail($user_id);

        return view('categories.show')->with(['articles'=>$articles,'user'=>$user,'category'=>$category]);
    }
    public function child_category($user_id,$child_category_id){
        $child_category = ChildCategory::findOrFail($child_category_id);
        $articles = ChildCategory::findOrFail($child_category_id)->articles;
        $user = User::findOrFail($user_id);

        return view('child_categories.show')->with(['articles'=>$articles,'user'=>$user,'child_category'=>$child_category]);
    }

    public function search(Request $request,$user_id)
    {
        $user = User::findOrFail($user_id);
        $articles = $user->articles()->where('title','like','%'.$request->input('search').'%')->get();
        return view('articles.search')->with(['articles'=>$articles,'user'=>$user]);
    }


}
