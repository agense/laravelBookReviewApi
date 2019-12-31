<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    // check if users password is correct
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $user = User::where('email', request()->email)->first();
            if (!$user || !Hash::check(request()->password, $user->password)) {
                $validator->errors()->add('password', 'Incorrect login credentials');
            }
        });
    }   
}
