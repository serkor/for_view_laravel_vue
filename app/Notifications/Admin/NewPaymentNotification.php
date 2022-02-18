<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentNotification extends Notification
{
    use Queueable;

    protected $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function via(): array
    {
        return ['mail', 'database'];
    }

    public function toDataBase(): array
    {
        return [
            'notify' => $this->object,
            'url' => route('admin_payments'),
            'name' => trans('notification.payment.name'). ' - '. $this->object['payment_id'],
            'text' => trans('notification.payment.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('admin_payments'),
            'name' => trans('notification.payment.name'),
            'text' => trans('notification.payment.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.payment.name'))
            ->view(
            'emails.admin.new_payment', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
