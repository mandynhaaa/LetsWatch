<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends BaseController
{
    use ResetsPasswords;
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }
}