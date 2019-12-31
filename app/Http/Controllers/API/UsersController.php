<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;

class UsersController extends Controller
{
    //Protect class with middleware
    public function __construct(){
        return $this->middleware('auth:api');
    }

    /**
     * Display a listing of all regilar users, i.e. without admins
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Allow only admins to see the list of all users
        $this->authorize('isAdmin');

        $users = User::where('role', '<>', 'admin')
        ->withCount('books')
        ->withCount('reviews')
        ->withCount('authors')
        ->orderBy('name', 'ASC')->orderBy('id', 'DESC');

        if(request()->has('paginate')){
            $users = $users->paginate(intval(request('paginate')));
            return UserResource::collection($users)->appends(request()->query());
         }else{
           $users = $users->get();
           return UserResource::collection($users);
         } 
    }

    /**
     * Display any user specified by id received as argument.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Allow only admins to see any selected user's data
        $this->authorize('isAdmin');

        $user->reviews_count = $user->reviews()->count();
        $user->books_count = $user->books()->count();
        $user->authors_count = $user->authors()->count();
        return new UserResource($user);  
    }
    /**
     * Display the authenticated users data.
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        //Allow authenticated user to view his data
        $this->authorize('isAccountOwner');
        $user = auth()->user();
        $user->reviews_count = $user->reviews()->count();
        $user->books_count = $user->books()->count();
        $user->authors_count = $user->authors()->count();
        return new UserResource($user);
    }

    /**
     * Update the authenticated users data
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //Allow authenticated user to update his data
        $this->authorize('isAccountOwner');

        $user = auth()->user();
        $this->validate($request, [
            'email' => ['required', 'string', 'max:191', 'email', Rule::unique('users')->ignore($user->id)],
            'name' => 'required|string|max:191|regex:/(^[A-Za-z ]+$)+/',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return new UserResource($user);
    }

    /**
     * Reset the authenticated users password
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        //Allow authenticated user to reset his password
        $this->authorize('isAccountOwner');

        $user = auth()->user();
        $this->validate($request, [
            'password' => 'required|string|min:8|max:20|confirmed',
            'current_password' => 'required|string|min:6|max:20'
        ]);
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Password Updated']);
        }
        return response(['errors'=> ['password' => 'Current password is incorrect']], 422); 
    }

    /**
     * Remove the specified user from database
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Allow only admins to delete users account
        $this->authorize('isAdmin');
        $user->delete();
        return response()->json(['message' => 'User Deleted']);
    }

}
