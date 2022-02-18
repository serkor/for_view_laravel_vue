<?php


namespace App\Logics\Interfaces;



interface ReminderLogicInterface
{
    public function index($user_id);

    public function store($request, $user_id);

    public function store_in_order($request);

    public function update($request);

    public function get_language();

}
