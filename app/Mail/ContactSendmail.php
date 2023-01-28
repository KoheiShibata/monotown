<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SplSubject;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $email;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        //
        $this->name = $contact["name"];
        $this->email = $contact["email"];
        $this->content = $contact["content"];
    }


    public function build()
    {
        return $this
            ->from("kohei.techis@gmail.com")
            ->subject("お問い合わせ")
            ->view("contact.mail")
            ->with([
                "name" => $this->name,
                "email" => $this->email,
                "content" => $this->content,
            ]);
    }
}
