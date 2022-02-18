<?php

namespace App\Notifications\All;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
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
            'url' => route('notifications'),
            'name' => trans('notification.message.name') . get_name_user($this->object['send_user_id']),
            'text' => $this->object['text'],
        ];
    }

    public function toMail(): MailMessage
    {
        $notify = [
            'notify' => $this->object,
            'url' => route('notifications'),
            'name' => trans('notification.message.name') . get_name_user($this->object['send_user_id']),
            'text' => $this->object['text'],
        ];

        return (new MailMessage)
            ->subject(trans('notification.message.name'))
            ->view(
            'emails.executor.message', ['object' => $this->object, 'notify' => $notify]
        );
    }
}
