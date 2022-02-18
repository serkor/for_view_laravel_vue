<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorNewCommentBidNotification extends Notification
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
            'url' => route('executor_bid', $this->object->bid->id),
            'name' => trans('notification.comment.name'),
            'text' => trans('notification.comment.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_bid', $this->object->bid->id),
            'name' => trans('notification.comment.name'),
            'text' => trans('notification.comment.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.comment.name'))
            ->view(
            'emails.executor.new_bid_comment', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
