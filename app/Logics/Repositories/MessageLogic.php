<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\MessageLogicInterface;
use App\Notifications\All\MessageNotification;

class MessageLogic implements MessageLogicInterface
{

    public function store($request)
    {
        get_user($request['get_user_id'])->notify(new MessageNotification($request));
    }

}
