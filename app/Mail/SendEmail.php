<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $body;

    public function __construct($data)
    {
        $this->name = $data['name'] ?? 'User';
        $this->body = $data['body'] ?? '';
    }

    public function build()
    {
        return $this->subject('Reset Password Notification')
                    ->view('emails.custom_reset_password')
                    ->with([
                        'name' => $this->name,
                        'body' => $this->body,
                    ]);
    }
}
