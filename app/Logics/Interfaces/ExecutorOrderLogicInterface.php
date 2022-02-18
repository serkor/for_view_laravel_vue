<?php


namespace App\Logics\Interfaces;


interface ExecutorOrderLogicInterface
{
    public function list($request, $filter);

    public function sum_period($request);
}
