<?php


namespace App\Logics\Interfaces;


interface PaymentLogicInterface
{
    public function all();

    public function index($id);

    public function responseurl();

}
