<?php


namespace App\Logics\Interfaces;


interface CategoryLogicInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

}
