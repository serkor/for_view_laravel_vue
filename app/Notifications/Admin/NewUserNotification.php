<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
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
            'url' => route('users.index'),
            'name' => trans('notification.user.name') .  ' - ID' . $this->object->id,
            'text' => trans('notification.user.text'),
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('users.index'),
            'name' => trans('notification.user.name'),
            'text' => trans('notification.user.text'),
        ];

        return (new MailMessage)
            ->subject(trans('notification.user.name'))
            ->view(
            'emails.admin.new_user', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
