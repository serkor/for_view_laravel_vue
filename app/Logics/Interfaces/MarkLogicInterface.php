<?php


namespace App\Logics\Interfaces;


interface MarkLogicInterface
{
    public function all();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

}
