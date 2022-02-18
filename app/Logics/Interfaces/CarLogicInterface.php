<?php


namespace App\Logics\Interfaces;


interface CarLogicInterface
{
    public function all();

    public function index();

    public function store($request);

    public function list($request);

    public function list_update($request);

//    public function update($request, $id);

}
