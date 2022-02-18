<?php

function get_name_user($id)
{
    $user = \App\Models\User::findOrFail($id);
    if($user->surname){
        return $user->name.' '.$user->surname;
    }else {
        return $user->name;
    }
}

function get_user($id)
{
   return \App\Models\User::findOrFail($id);
}

function get_list_admin()
{
    return \App\Models\User::whereHas('roles', function ($role) {
        $role->where('name', 'like', 'admin');
    })->get();
}
