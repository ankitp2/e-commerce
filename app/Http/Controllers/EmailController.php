<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
class EmailController extends Controller
{
    public function sendWelcomeEmail(){
        $toEmail='ankitkumarparida02@gmail.com';
        $message='This is a testing mail from Ankit';
        $subject='Welcome Email in Laravel Using Gmail';
        $response= Mail::to($toEmail)->send(new WelcomeEmail($message,$subject));

    }
}
