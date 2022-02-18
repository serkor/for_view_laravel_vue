<?php

use App\Models\Executor;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

function check_premium($id)
{
    if (Executor::findOrFail($id)->package_id == 2) {
        return true;
    } else {
        return false;
    }
}

function get_list_executor()
{
    return \App\Models\Executor::whereHas('roles', function ($role) {
        $role->where('name', 'like', 'executor');
    })->get();
}

function check_count_add_offers($id)
{
    $executor = Executor::findOrFail($id);
    $offers = DB::table('executor_offers')
        ->where('executor_id', $executor->id)
        ->get();

    if($executor->package_id == 1){
        $package = Package::findOrFail(1);
        if (count($offers) >= $package->limit_offers) {
            return false;
        } else {
            return true;
        }
    }else {
        return true;
    }

}
