<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all()->sortByDesc('id');
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          // $roles=Role::lists('name','id')->all();
          $roles=Role::all()->sortByDesc('id');

          return view('admin.users.create',compact('roles'));
          // return view('admin.users.create',compact('roles'));
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
            'name'=>'required | min:3',
            'email' => [
                'required','email:rfc',
                function($attribute,$value,$fail){
                    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                        $fail($attribute.' is invalid.');
                    }
                }
            ],
            'password'=>'required | min:8',
            'status'=>'required',
            'role'=>'required'
        ]);

        // create user
        $user=new User();

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=bcrypt($request->input('password'));
        $user->is_active=$request->input('status');
        $user->role_id=$request->input('role');

        if($file=$request->file('picture')){
            $name=time().$file->getClientOriginalName();



            $photo=new Photo();
            $photo->file=$name;

            if($photo->save()){
                $file->move('images\profile_pictures',$name);

                $user->photo_id=$photo->id;
            }else{
                return redirect(route('users.create'))->with('fail','Unable to save your image');
            }

        }else{
            $user->photo_id=0;
        }

        $all_users=User::all();
        foreach($all_users as $user1){

            if($user1->name==$user->name){
                return redirect(route('users.create'))->with('fail','username is already taken');
            }elseif($user1->email==$user->email){
                return redirect(route('users.create'))->with('fail','email is already taken');
            }elseif($user->save()){
                return redirect(route('users.index'))->with('success','User Added successfully');
            }else{
                return view('admin.users.create',compact('request'));
            }

        }
        // User::create($request->all());
        // return redirect(route('users.index'))->with('success','User Added successfully');





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
        return view('admin.users.show');
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
        $roles=Role::all()->sortByDesc('id');

        $user=User::find($id);

        return view('admin.users.edit',compact('roles'))->with('user',$user);
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
            'name'=>'required | min:3',
            'email' => [
                'required','email:rfc',
                function($attribute,$value,$fail){
                    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                        $fail($attribute.' is invalid.');
                    }
                }
            ],
            'password'=>'required | min:8',
            'status'=>'required',
            'role'=>'required'
        ]);

        // create user
        $user=User::find($id);

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=bcrypt($request->input('password'));
        $user->is_active=$request->input('status');
        $user->role_id=$request->input('role');

        if($user->photo_id!=0){
            $delete_photo=unlink(public_path().$user->photo->file);
            $photo=Photo::find($user->photo_id);
            $photo->delete();
            }

        if($file=$request->file('picture')){
            $name=time().$file->getClientOriginalName();



            $photo=new Photo();
            $photo->file=$name;

            if($photo->save()){
                $file->move('images\profile_pictures',$name);

                $user->photo_id=$photo->id;
            }else{
                return redirect(route('users.create'))->with('fail','Unable to save your image');
            }

        }else{
            $user->photo_id=0;
        }

        $all_users=User::all();
        foreach($all_users as $user1){

            if($user1->name==$user->name){
                return redirect(route('users.edit',$id))->with('fail','username is already taken');
            }elseif($user1->email==$user->email){
                return redirect(route('users.edit',$id))->with('fail','email is already taken');
            }elseif($user->update()){
                return redirect(route('users.index'))->with('success','User edited successfully');
            }else{
                return view('users.edit',compact('request'));
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
        $user=User::find($id);

        if($user->photo_id!=0){
        $delete_photo=unlink(public_path().$user->photo->file);
        $photo=Photo::find($user->photo_id);
        $photo->delete();
        }


        $user->delete();


        return redirect(route('users.index'))->with('success','User deleted successfully');
    }
}
