<?php


namespace App\Logics\Interfaces;


interface AppealLogicInterface
{
    public function all();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

}
