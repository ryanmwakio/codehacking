<?php


namespace App\Http\Controllers;


use App\Post;
use App\User;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all()->sortByDesc('id');
        $photos=Photo::all();


        return view('admin.posts.index',compact('posts'))->with('photos',$photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('admin.posts.create',compact('categories'));
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
            'category'=>'required',
            'title' => 'required',
            'body'=>'required'
        ]);


        //create post
        $post=new Post();

        $user=Auth::user();

        $post->user_id=$user->id;
        $post->category_id=$request->input('category');
        $post->title=$request->input('title');
        $post->body=$request->input('body');

        if($file=$request->file('picture')){
            $name=time().$file->getClientOriginalName();

            $photo=new Photo();
            $photo->file=$name;

            if($photo->save()){
                $file->move('images\post_pictures',$name);

                $post->photo_id=$photo->id;
            }
        }else{
            $post->photo_id=0;
        }

        if($post->save()){
            return redirect(route('posts.index'))->with('success','post created successfully');
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
        $post=Post::find($id);
        $categories=Category::all();

        return view('admin.posts.edit',compact('post',$post))->with('categories',$categories);
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
            'category'=>'required',
            'title' => 'required',
            'body'=>'required'
        ]);

        $post=Post::find($id);

        if($post->photo_id!=0){
            $photo=Photo::find($post->photo_id);

            $delete_photo=unlink(public_path().'/images/post_pictures/'.$photo->file.'');
            $photo->delete();
        }


        $post->user_id=$post->user_id;
        $post->category_id=$request->input('category');
        $post->title=$request->input('title');
        $post->body=$request->input('body');



        if($file=$request->file('picture')){
            $name=time().$file->getClientOriginalName();

            $photo=new Photo();
            $photo->file=$name;

            if($photo->save()){
                $file->move('images\post_pictures',$name);

                $post->photo_id=$photo->id;
            }
        }else{
            $post->photo_id=0;
        }



        if($post->update()){
            return redirect(route('posts.index'))->with('success','post edited successfully');
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
        $post=Post::find($id);

        if($post->photo_id!=0){
            $photo=Photo::find($post->photo_id);

            $delete_photo=unlink(public_path().'/images/post_pictures/'.$photo->file.'');
            $photo->delete();
        }


        $post->delete();


        return redirect(route('posts.index'))->with('success','Post deleted successfully');
    }

}
