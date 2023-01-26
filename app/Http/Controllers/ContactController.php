<?php

namespace App\Http\Controllers;

use App\Mail\ContactSendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //

    public function contact() {
        return view("/contact");
    }


    public function send(Request $request) {
        Mail::to("kohei.techis@gmail.com")->send(new ContactSendmail());
    }

    
}
