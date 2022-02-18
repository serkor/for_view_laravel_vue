<?php

namespace App\Notifications\Executor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutorDisablePackageNotification extends Notification
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
            'url' => route('executor_packages'),
            'name' => trans('notification.disable_package.name'),
            'text' => trans('notification.disable_package.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('executor_packages'),
            'name' => trans('notification.disable_package.name'),
            'text' => trans('notification.disable_package.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.disable_package.name'))
            ->view(
            'emails.executor.disable_package', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
