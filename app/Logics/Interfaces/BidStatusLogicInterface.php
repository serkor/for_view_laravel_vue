<?php


namespace App\Logics\Interfaces;


interface BidStatusLogicInterface
{
    public function all();

    public function list($type);

    public function update($request, $id = null);
}
