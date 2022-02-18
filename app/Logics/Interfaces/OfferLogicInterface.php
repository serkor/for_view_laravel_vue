<?php


namespace App\Logics\Interfaces;


interface OfferLogicInterface
{
    public function listCustomer($request);

    public function listExecutor($request);

    public function store($request);

    public function select($request);

    public function unselect($request);
}
