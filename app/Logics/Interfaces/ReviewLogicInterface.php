<?php


namespace App\Logics\Interfaces;


interface ReviewLogicInterface
{

    public function index();

    public function personal($user_id);

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function get_list($id);

}
