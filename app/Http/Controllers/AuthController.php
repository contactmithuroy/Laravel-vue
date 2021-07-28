<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function update_user(Request $request){
        $user = auth()->user();
        $this->validate($request,[
            'name'=>'required',
            'email'=>"required|unique:users,email,$user->id",
            'password'=>'sometimes|nullable|confirmed|min:8',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
       }
       $user->save();
        return response()->json($user,200);
    }
}
