<?php


namespace App\Logics\Interfaces;


interface PackageLogicInterface
{

    public function all();

    public function index();

    public function edit($id);

    public function update($request, $id);

    public function buy($id, $executor_id);

}
