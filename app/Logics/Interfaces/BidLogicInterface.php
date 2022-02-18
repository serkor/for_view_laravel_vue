<?php


namespace App\Logics\Interfaces;


interface BidLogicInterface
{
    public function all();

    public function show($id);

    public function update($request);

}
