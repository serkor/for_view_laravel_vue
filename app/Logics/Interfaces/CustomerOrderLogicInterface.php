<?php


namespace App\Logics\Interfaces;


interface CustomerOrderLogicInterface
{

    public function list($request, $filter);

    public function sum_period($request);

}
