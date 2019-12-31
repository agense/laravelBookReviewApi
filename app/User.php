<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Laravel\Passport\Client as PassportClient;
use GuzzleHttp\Client;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Override the default forgot password notification
     */
    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Relationship with Review Model
     */
    public function authors(){
        return $this->hasMany(Author::class);
    }

    /**
     * Relationship with Book Model
     */
    public function books(){
        return $this->hasMany(Book::class);
    }

    /**
     * Relationship with Review Model
     */
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    /**
     * Authenticate users via api
     * Isues an access_token using GuzzleHttp and Passport's Password Grand Client
     * Returns token data as array or false on failure.
     */
    public function authenticate(){
        //Get passport grand client data from DB
        $passwordGrantClient = PassportClient::where('password_client', 1)->first();

        //issue access token -use the guzzle http library to make a request for the token.
        $http = new \GuzzleHttp\Client;
        try{
            $response = $http->post(route('passport.token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $passwordGrantClient->id,
                    'client_secret' => $passwordGrantClient->secret,
                    'username' => $this->email,
                    'password' => request()->password,
                    'scope' => '',
                ],
            ]);
            $auth = json_decode((string) $response->getBody(), true);
            return $auth;
        }catch(\Exception $e){
            return false;
        }
    }
}
