<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use App\Models\Order;
class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $data, $setting, $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->setting = Setting::first();
        $this->order = Order::find($this->data['order_id']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_status')->subject('Order Status');
    }
}
