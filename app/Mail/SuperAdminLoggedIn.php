<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuperAdminLoggedIn extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ipAddress;
    public $locationUrl;

    public function __construct($user, $ipAddress, $locationUrl)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->locationUrl = $locationUrl;
    }

    public function build()
    {
        return $this->view('emails.super_admin_logged_in')
                    ->subject('Super Admin Logged In')
                    ->with([
                        'user' => $this->user,
                        'ipAddress' => $this->ipAddress,
                        'locationUrl' => $this->locationUrl,
                    ]);
    }
}
