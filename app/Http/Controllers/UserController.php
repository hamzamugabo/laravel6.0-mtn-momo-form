<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function sendMail()
    {
        $to_name = 'atwiinenicxon';
        $to_email = 'atwiinenicxon@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail', '');
            $message->from('hamzamugabo3@gmail.com','Hamuza Mugabo');
        });

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->json('Yes, You have sent email to GMAIL from LARAVEL 6 !!');
        }
    }
}
