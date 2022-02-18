<?php


namespace App\Logics\Interfaces;


interface FavoriteLogicInterface
{
    public function get_list();

    public function add($id);

    public function del($id);

}
