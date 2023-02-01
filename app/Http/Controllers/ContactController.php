<?php

namespace App\Http\Controllers;

use App\Mail\ContactSendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //

    public function contact() 
    {
        return view("/contact.form");
    }



    public function send(Request $request)
    {
        $contact = $request->validate(config(CONTACT_VALIDATE));
        Mail::to("kohei.techis@gmail.com")->send(new ContactSendmail($contact));

        $request->session()->flush();
        return redirect("/monotown")->with("successMessage", "お問い合わせありがとうございました。");
    }


}
