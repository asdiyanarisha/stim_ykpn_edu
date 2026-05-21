<?php

namespace App\Mail;

use App\Models\Pmb;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PmbRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pmb;

    /**
     * Create a new message instance.
     *
     * @param Pmb $pmb
     */
    public function __construct(Pmb $pmb)
    {
        $this->pmb = $pmb;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pendaftaran Mahasiswa Baru - STIM YKPN')
                    ->view('emails.pmb-registration');
    }
}
