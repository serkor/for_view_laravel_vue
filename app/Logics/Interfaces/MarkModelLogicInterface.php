<?php


namespace App\Logics\Interfaces;


interface MarkModelLogicInterface
{
    public function all();

    public function store($request);

    public function create();

    public function edit($id);

    public function update($request, $id);

    public function get_list($id);

}
