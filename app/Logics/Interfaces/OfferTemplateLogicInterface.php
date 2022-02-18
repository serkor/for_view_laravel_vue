<?php


namespace App\Logics\Interfaces;


interface OfferTemplateLogicInterface
{
    public function list($request);

    public function store($request);

    public function delete($request);
}
