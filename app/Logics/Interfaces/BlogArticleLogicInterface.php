<?php


namespace App\Logics\Interfaces;


interface BlogArticleLogicInterface
{
    public function index();

    public function create();

    public function edit($id);

    public function store($request);

    public function update($request, $id);

}
