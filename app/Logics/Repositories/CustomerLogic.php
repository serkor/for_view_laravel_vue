<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CustomerLogicInterface;
use App\Models\City;
use App\Models\Customer;
use App\Models\File;
use App\Models\Role;

class CustomerLogic implements CustomerLogicInterface
{
    protected $customer;
    protected $fileLogic;

    public function __construct(Customer $customer, FileLogic $fileLogic)
    {
        $this->customer = $customer;
        $this->fileLogic = $fileLogic;
    }

    public function index()
    {
        return $this->customer->whereHas( 'roles', function ( $role ) {
            $role->where( 'name', 'like', 'customer' );
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
        $this->customer->create($request)->roles()->sync($request['role_id']);
    }

    public function edit($id)
    {
        $customer = $this->customer->findOrFail($id);
        $cities = City::all();
        $roles = Role::all()->pluck('name', 'id');

        return ['customer' => $customer, 'cities' => $cities, 'roles' => $roles];
    }

    public function update($request, $id)
    {
        $new_customer = $this->customer->findOrFail($id);
        $new_customer->update($request);
        $new_customer->roles()->sync(3);
    }

    public function profile($id)
    {
        $customer = $this->customer->findOrFail($id);

        return ['customer' => $customer];
    }

    public function update_account($request, $id)
    {
        $customer = $this->customer->findOrFail($id);
        $customer->update($request);

        if (!empty($request['image'])) {
            $image_name = $this->fileLogic->UploadLogo($request['image']);
            $customer->update(['image' => $image_name]);
        }
    }

    public function update_settings($request, $id)
    {
        $customer = $this->customer->findOrFail($id);
        $customer->get_email = $request['get_email'] ?? 0;
        $customer->show_profile = $request['show_profile'] ?? 0;
        $customer->save();
    }

}
