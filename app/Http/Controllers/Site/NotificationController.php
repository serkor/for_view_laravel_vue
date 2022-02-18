<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\NotificationLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationLogic;

    public function __construct(NotificationLogic $notificationLogic)
    {
        $this->notificationLogic = $notificationLogic;
    }

    public function index()
    {
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/notification.php')));

        return view('site.account.all.notifications', compact('lang'));
    }

    public function get_list()
    {
        $result = $this->notificationLogic->index(Auth::id());

        return response()->json([
            'notifications' => $result['notifications'],
            'all_count' => $result['all_count'],
        ], 200);
    }

    public function count()
    {
        $notifications = $this->notificationLogic->count(Auth::id());

        return response()->json(count($notifications), 200);
    }

    public function read(Request $request)
    {
        $result = $this->notificationLogic->read(Auth::id(), $request['id']);

        return response()->json($result, 200);
    }

//    public function read()
//    {
//        foreach (Auth::user()->unreadNotifications->where('type', 'App\Notifications\NewOfferOrder') as $notification) {
//            $notification->markAsRead();
//        }
//    }
}
