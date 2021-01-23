<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;



class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('publicUsers.edit');
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
            ]
        ]);

        $user=User::find($id);

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=$user->password;
        $user->is_active=$user->is_active;
        $user->role_id=$user->role_id;



        if($user->photo_id!=0){
            $photo=Photo::find($user->photo_id);

            $delete_photo=unlink(public_path().'/images/profile_pictures/'.$photo->file.'');
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
                    return redirect(route('home'))->with('fail','Unable to save your image');
                }

            }else{
                $user->photo_id=0;
            }

            // $all_users=User::all();
            // foreach($all_users as $user1){

            //     if($user1->name==$user->name){
            //         return redirect(route('public.edit',$id))->with('fail','username is already taken');
            //     }elseif($user1->email==$user->email){
            //         return redirect(route('public.edit',$id))->with('fail','email is already taken');
            //     }elseif($user->update()){
            //         return redirect(route('home'))->with('success','User updated successfully');
            //     }else{
            //         return view('publicUsers.edit',compact('request'));
            //     }
            // }

            if($user->update()){
                return redirect(route('home'))->with('success','User updated successfully');
            }else{
                return view('publicUsers.edit',compact('request'));
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
            $photo=Photo::find($user->photo_id);

            $delete_photo=unlink(public_path().'/images/profile_pictures/'.$photo->file.'');
            $photo->delete();
        }


        $user->delete();


        return redirect(route('welcome'))->with('success','User deleted successfully');
    }
}
