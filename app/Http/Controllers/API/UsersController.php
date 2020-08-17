<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Intervention\Image;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //   $this->authorize('isAdmin');
       
        // if (Gate::allows('isAdmin') || Gate::allows('isUser')) {
            return User::all();
            // The current user can edit settings
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate($request,[
        //     'name'=>'required|string|max:191',
        //     'email'=>'required|string|max:191|unique:users',
        //     'password'=>'required|string|min:6',
        // ]);
        return User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'bio'=>$request['bio'],
            'type'=>$request['type'],
            'password'=>Hash::make($request['password']),
        ]);
    //    return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return auth('api')->user();
    }

     public function updateProfile(Request $request)
    {
        $user= auth('api')->user();
        $currentPhoto=$user->photo;
        // return $request->photo;
        // return ['message'=>"hello"];
         if($request->photo !=  $currentPhoto){
             $photoName = time().'.'.explode('/',explode(':',substr($request->photo,0,strpos($request->photo,';')))[1])[1];
            // Image save in folder only name
             \Image::make($request->photo)->save(public_path('img/profile/').$photoName);
          // return $request->photo;
          $request->merge(['photo'=>$photoName]);
        }
        
        $user->update($request->all());
        return ['message'=> "success"];
         
        
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
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=>'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=>'sometimes|min:6'
        ]);
        $user->update($request->all());
        return['messsage'=>"hello"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=> "delete"];
    }
}
