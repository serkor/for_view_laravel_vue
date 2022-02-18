<?php

namespace App\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerNewOfferNotification extends Notification
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
            'name' => trans('notification.offer.name'),
            'text' => trans('notification.offer.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('customer_bid', $this->object->bid->id),
            'name' => trans('notification.offer.name'),
            'text' => trans('notification.offer.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.offer.name'))
            ->view(
            'emails.customer.new_offer', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
