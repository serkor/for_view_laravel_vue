<?php


namespace App\Logics\Interfaces;


interface CustomerBidLogicInterface
{

    public function index($customer);

    public function store($request);

    public function show($id);

    public function count($request);

    public function list($request);

}
