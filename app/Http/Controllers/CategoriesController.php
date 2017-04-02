<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['store','edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Auth::user()->categories()->get();
        return view('categories.index')->with('categories',$categories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
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

            $category = new Category();
            $category->fill([
               'user_id'=>Auth::user()->id,
                 'name'=>$request->input('name'),
            ]);
            $category->save();


        return response()->json(['name'=>$category->name,'id'=>$category->id]);
//        $category->fill([
//           'user_id'=>Auth::user()->id,
//           'parent_id'=>$request->input('parent_id'),
//            'name'=>$request->input('name'),
//
//        ]);
//        if ($category->save()){
//            return redirect()->route('categories.index',Auth::user()->id);
//        }else{
//            return back();
//        }
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
        $category = Category::findOrFail($id);
        $articles = $category->articles()->paginate(5);
        $user = User::findOrFail($user_id);

        return view('categories.show')->with(['articles'=>$articles,'user'=>$user,'category'=>$category]);
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
        Category::findOrFail($id)->delete();
        return response()->json(['status'=>0]);
    }
//    static public $treeList = array();
//
//    static public function tree(&$data,$pid = 0,$count = 1) {
//        foreach ($data as $key => $value){
//            if($value['parent_id']==$pid){
//                $value['Count'] = $count;
//                self::$treeList []=$value;
//                unset($data[$key]);
//                self::tree($data,$value['Id'],$count+1);
//            }
//        }
//        return self::$treeList ;
//    }

}
