<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Hash;


//Resource
use App\Http\Resources\AuthUser as AuthUserResource;

class AuthController extends Controller
{
    /**
     * New user registration and autologin
     * @param  App\Http\Requests\RegistrationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegistrationRequest $request)
    {
        // create a new user and save in db
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        //AUTOLOGIN
        // Use model class method to issue access token. Append users data on to it and return as json.
        $auth = $user->authenticate();
        if($auth){
            $auth['user'] = new AuthUserResource($user);
            return response(['auth' => $auth]);
        }else{
            $user->delete();
            return response()->json(['error'=> 'Token Request Error'], 500);
        }
    }

    /**
     * User login
     * @param  App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response 
     */
    public function login(LoginRequest $request)
    {
        //find the user by username/email
        $user = User::where('email', $request->email)->first();

        //Use model class method to issue access token. Append users data on to it and return as json. 
        $auth = $user->authenticate();
        if($auth){
            $auth['user'] = new AuthUserResource($user);
            return response(['auth' => $auth]);
        }
        return response()->json(['error'=> 'Token Request Error'], 500);     
    }
}
