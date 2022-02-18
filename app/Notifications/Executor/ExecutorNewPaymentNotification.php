<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorNewPaymentNotification extends Notification
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
            'url' => route('executor_payments'),
            'name' => trans('notification.payment.name'),
            'text' => trans('notification.payment.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_payments'),
            'name' => trans('notification.payment.name'),
            'text' => trans('notification.payment.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.payment.name'))
            ->view(
            'emails.executor.new_payment', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
