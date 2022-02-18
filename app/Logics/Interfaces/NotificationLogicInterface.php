<?php


namespace App\Logics\Interfaces;


interface NotificationLogicInterface
{
    public function index($id);

    public function count($id);

    public function read($user_id, $id);

}
