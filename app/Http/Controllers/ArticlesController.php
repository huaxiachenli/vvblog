<?php

namespace App\Http\Controllers;

use App\Article;
//use App\ArticleTag;
use App\ChildCategory;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Javascript;


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
        $articles = $user->articles()->latest()->paginate(5);
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
        if(Auth::user()->child_categories->isEmpty()){
            \Session::flash('danger','请先添加菜单项');
            return redirect()->route('dashboard',Auth::user()->id);
        }else{
            $user = User::findOrFail($user_id);
            $tags = \App\Tag::pluck('name', 'id');
            $categories = $user->categories;
            return view('articles.create')->with(['user'=>$user,'categories'=>$categories,'tags'=>$tags]);
        }

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
        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required',
            'child_category_id'=>'integer|required',
            'intro'=>'required|string',
            'logo'=>'file|image'
        ]);
        $user = User::findOrFail($user_id);
        $child_category = ChildCategory::findOrFail($request->input('child_category_id'));
        if ($request->hasFile('logo')){
            $filename = $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->move('uploads/logos/',$filename)->getPathname();

        }else{
            $path=null;
        }
        $article = new Article();

        $article->fill([
            'user_id'=>Auth::user()->id,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'category_id'=>$child_category->category->id,
            'child_category_id'=>$child_category->id,
            'intro'=>$request->input('intro'),
            'logo'=>$path
        ]);
        $article->tags()->attach($request->tag_list);
        if ($article->save()){

//            foreach ($request->tag as $tag){
//                $currentTag = Tag::firstOrCreate(['name'=>$tag]);
//                $article->tags()->attach($currentTag,['user_id'=>Auth::user()->id]);
//            }
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
        Javascript::put([
            'comments'=>$article->comments

        ]);
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
        $tags = $user->tags()->pluck('name');


        return view('articles.edit')->with(['article'=>$article,'user'=>$user,'tags'=>$tags,'tag_list'=>$article->tagList]);
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
        $child_category = ChildCategory::findOrFail($request->input('child_category_id'));
        $article = Auth::user()->articles()->find($id);
        $article->update([
            'user_id'=>Auth::user()->id,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'category_id'=>$child_category->category->id,
            'child_category_id'=>$child_category->id,
            'intro'=>$request->input('intro'),
        ]);
        $article->tags()->sync($request->tag_list);
//        ArticleTag::where('article_id',$id)->delete();
//        foreach ($request->tag as $tag){
//            $collectTag = Tag::firstOrCreate(['name'=>$tag]);
//
//               ArticleTag::create(['user_id'=>Auth::user()->id,'article_id'=>$id,'tag_id'=>$collectTag->id]);
//
//        }

        \Session::flash('success','保存成功');
        return redirect()->route('articles.show',[Auth::user()->id,$id])->with(['user'=>Auth::user(),'article'=>$article]);
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

//    public function category($user_id,$category_id){
//        $category = Category::findOrFail($category_id);
//        $articles = $category->articles()->paginate(5);
//        $user = User::findOrFail($user_id);
//
//        return view('categories.show')->with(['articles'=>$articles,'user'=>$user,'category'=>$category]);
//    }
//    public function child_category($user_id,$child_category_id){
//        $child_category = ChildCategory::findOrFail($child_category_id);
//        $articles = ChildCategory::findOrFail($child_category_id)->articles()->paginate(5);
//        $user = User::findOrFail($user_id);
//
//        return view('child_categories.show')->with(['articles'=>$articles,'user'=>$user,'child_category'=>$child_category]);
//    }

    public function search(Request $request,$user_id)
    {
        $user = User::findOrFail($user_id);
        $articles = $user->articles()
            ->where('title','like','%'.$request->input('search').'%')
            ->orWhere('intro','like','%'.$request->input('search').'%')->paginate(5);
        return view('articles.search')->with(['articles'=>$articles,'user'=>$user,'search'=>$request->input('search')]);
    }


}
