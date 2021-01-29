<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();



        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 123;
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
            'category'=>'required'
        ]);


        $category_name=Str::upper($request->input('category'));

        $categories=Category::all();

        foreach($categories as $category){
            if($category->name==$category_name){
                return redirect(route('categories.index'))->with('fail','category already exists');
            }else{
                $category=new Category();

                $category->name=$category_name;
                if($category->save()){
                    return redirect(route('categories.index'))->with('success','category has been created successfully');
                }
            }
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
        $category=Category::find($id);

        return view('admin.categories.edit',compact('category'));
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
            'category'=>'required'
        ]);

        $category=Category::find($id);

        $categories=Category::all();

        $category_name=Str::upper($request->input('category'));




        foreach($categories as $category2){
            if($category2->name==$category_name){
                return redirect(route('editCategory'))->with('fail','category already exists');
            }else{
                $category->name=$category_name;
                if($category->update()){
                    return redirect(route('categories.index'))->with('success','category edited successfully');
                }
            }
        }



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

        $category=Category::find($id);
        $category->delete();
        return redirect(route('categories.index'))->with('success','category deleted successfully');
    }
}
