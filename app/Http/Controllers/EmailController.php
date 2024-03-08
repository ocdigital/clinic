<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Events\EmailSent;

class EmailController extends Controller
{
    public function sendWelcomeEmail ()
    {
        $title = 'Welcome to Laravel 8';
        $body = 'This is a test email';

        Mail::to('eduardoferreira85@gmail.com')->send(new WelcomeMail($title, $body));

        event(new EmailSent($title, $body));

        return 'Email was sent';
    }
}
