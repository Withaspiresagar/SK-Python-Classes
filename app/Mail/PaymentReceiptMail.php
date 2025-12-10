<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\BrandSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $brandSettings;

    /**
     * Create a new message instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment->load(['user', 'course']);
        $this->brandSettings = BrandSetting::first();
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Payment Receipt - ' . ($this->brandSettings->brand_name ?? 'SK Python Classes'))
                    ->view('emails.payment-receipt')
                    ->with([
                        'payment' => $this->payment,
                        'brandSettings' => $this->brandSettings,
                    ]);
    }
}
