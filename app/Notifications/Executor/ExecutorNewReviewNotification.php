<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorNewReviewNotification extends Notification
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
            'url' => route('executor_profile'),
            'name' => trans('notification.review.name'),
            'text' => trans('notification.review.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_profile'),
            'name' => trans('notification.review.name'),
            'text' => trans('notification.review.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.review.name'))
            ->view(
            'emails.executor.new_review', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
