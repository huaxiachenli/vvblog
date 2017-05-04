<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Tag;
use YuanChao\Editor\EndaEditor;

class ArticlesController extends Controller
{
    /**
     * ArticlesController constructor.
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
        return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.articles.create');
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
        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required',
            'child_category_id'=>'integer|required',
            'intro'=>'required|string',
            'logo'=>'file|image'
        ]);
        $user = Auth::user();
        $child_category = Auth::user()->child_categories()->findOrFail($request->input('child_category_id'));
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

        if ($article->save()){

            foreach ($request->tag as $tag){
                $currentTag = Tag::firstOrCreate(['name'=>$tag]);
                $article->tags()->attach($currentTag,['user_id'=>Auth::user()->id]);
            }
            \Session::flash('success','保存成功');
            return redirect('/admin/articles');
        }else{
            \Session::flash('danger','保存失败');
            return redirect()->route('articles.create')->with('user',$user);
        }
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

        //
        $article = Article::find($id);
        $tags = Auth::user()->tags()->pluck('name');

        return view('admin.articles.edit')->with(['article'=>$article,'tags'=>$tags]);
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
        $child_category = ChildCategory::findOrFail($request->input('child_category_id'));
        $article = Article::find($id);
        $article->update([
            'user_id'=>Auth::user()->id,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'category_id'=>$child_category->category->id,
            'child_category_id'=>$child_category->id,
            'intro'=>$request->input('intro'),
        ]);
        ArticleTag::where('article_id',$id)->delete();
        foreach ($request->tag as $tag){
            $collectTag = Tag::firstOrCreate(['name'=>$tag]);

            ArticleTag::create(['user_id'=>Auth::user()->id,'article_id'=>$id,'tag_id'=>$collectTag->id]);

        }

        \Session::flash('success','保存成功');
        return redirect()->route('articles.show',[Auth::user()->id,$id])->with(['user'=>Auth::user(),'article'=>$article]);

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
        $article = Auth::user()->articles()->find($id);
        if($article->delete()){
            return response()->json(['status'=>0]);
        }
    }

    public function upload(){

        // path 为 public 下面目录，比如我的图片上传到 public/uploads 那么这个参数你传uploads 就行了

        $data = EndaEditor::uploadImgFile('path');

        return json_encode($data);

    }

}
