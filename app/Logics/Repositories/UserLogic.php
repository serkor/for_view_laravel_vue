<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\UserLogicInterface;
use App\Models\City;
use App\Models\Role;
use App\Models\User;

class UserLogic implements UserLogicInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->whereHas( 'roles', function ( $role ) {
            $role->where( 'name', 'like', 'admin' );
        } )->paginate(10);
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::where('id', 1)->pluck('name', 'id');

        return ['cities' => $cities, 'roles' => $roles];
    }

    public function store($request)
    {
        $this->user->create($request)->roles()->sync($request['role_id']);
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        $cities = City::all();
        $roles = Role::all()->pluck('name', 'id');

        return ['user' => $user, 'cities' => $cities, 'roles' => $roles];
    }

    public function update($request, $id)
    {
        $new_user = $this->user->findOrFail($id);
        $new_user->update($request);
        $new_user->roles()->sync($request['role_id']);
    }
}
