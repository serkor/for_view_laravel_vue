<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\NotificationLogicInterface;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class NotificationLogic implements NotificationLogicInterface
{

    protected $notification;

    public function __construct(Notification $notification){

        $this->notification = $notification;
    }

    public function index($id)
    {
        $notifications = User::findOrFail($id)->unreadNotifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return [
            'all_count' => $notifications->total(),
            'notifications' => $notifications,
        ];
    }

    public function count($id)
    {
        return User::findOrFail($id)->unreadNotifications;
    }

    public function read($user_id, $id)
    {
       return User::findOrFail($user_id)->notifications
           ->where('id', $id)
           ->markAsRead();
    }

}
