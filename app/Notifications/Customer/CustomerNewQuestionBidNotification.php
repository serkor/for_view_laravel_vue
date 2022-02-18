<?php

namespace App\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerNewQuestionBidNotification extends Notification
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
            'url' => route('customer_bid', $this->object->bid->id),
            'name' => trans('notification.question.name'),
            'text' => trans('notification.question.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('customer_bid', $this->object->bid->id),
            'name' => trans('notification.question.name'),
            'text' => trans('notification.question.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.question.name'))
            ->view(
            'emails.customer.new_bid_question', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
