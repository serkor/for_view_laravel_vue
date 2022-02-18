<?php


namespace App\Logics\Interfaces;


interface ExecutorBidLogicInterface
{

    public function index($executor);

    public function show($id);

    public function count($request);

    public function list($request, $filter);

}
