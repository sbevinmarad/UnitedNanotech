<?php

namespace App\Mail;

use App\Models\Enquery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnqueryMailSendToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $data, $booking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->booking = Enquery::find($this->data['id']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Product Enquery Mail';
        return $this->markdown('emails.EnqueryMailSendToAdmin')->subject($subject);
    }
}
