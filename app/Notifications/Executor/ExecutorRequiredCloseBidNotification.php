<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ExecutorRequiredCloseBidNotification extends Notification
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
            'url' => route('executor_bids'),
            'name' => trans('notification.info_require_status_bid.name'),
            'text' => trans('notification.info_require_status_bid.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_bids'),
            'name' => trans('notification.info_require_status_bid.name'),
            'text' => trans('notification.info_require_status_bid.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.info_require_status_bid.name'))
            ->view(
                'emails.executor.info_require_status_bid', ['object' => $this->object, 'notify' => $notify]
            );
    }
}
