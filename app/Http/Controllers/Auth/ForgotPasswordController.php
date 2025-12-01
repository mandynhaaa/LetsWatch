<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends BaseController
{
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest');
    }
}