<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorChangeStatusOfferNotification extends Notification
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
            'url' => route('executor_bid', $this->object->bid_id),
            'name' => trans('notification.status_offer.name'),
            'text' => trans('notification.status_offer.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_bid', $this->object->bid_id),
            'name' => trans('notification.status_offer.name'),
            'text' => trans('notification.status_offer.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.status_offer.name'))
            ->view(
            'emails.executor.change_status_offer_bid', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
