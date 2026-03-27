<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\Rules;

class ResetPasswordController extends BaseController
{
    use ResetsPasswords;
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', Rules\Password::defaults()],
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}