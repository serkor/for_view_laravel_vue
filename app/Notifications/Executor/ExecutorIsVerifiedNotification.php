<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorIsVerifiedNotification extends Notification
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
            'name' => trans('notification.is_verified.name'),
            'text' => trans('notification.is_verified.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_profile'),
            'name' => trans('notification.is_verified.name'),
            'text' => trans('notification.is_verified.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.is_verified.name'))
            ->view(
            'emails.executor.is_verified', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
