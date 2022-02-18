<?php


namespace App\Logics\Interfaces;


interface ExecutorLogicInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function profile($id);

    public function show($id);

    public function update_account($request, $id);

    public function update_settings($request, $id);

}
