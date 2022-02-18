<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\User\StoreCustomerRequest;
use App\Http\Requests\Users\User\UpdateUserRequest;
use App\Logics\Repositories\UserLogic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $userLogic;

    public function __construct(UserLogic $userLogic)
    {
        $this->userLogic = $userLogic;
    }

    public function index()
    {
        $users = $this->userLogic->index();

        return view('front.users.admin.index', compact('users'));
    }

    public function create()
    {
        $result = $this->userLogic->create();
        $cities = $result['cities'];
        $roles = $result['roles'];

        return view('front.users.admin.create', compact('roles', 'cities'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->userLogic->store($request->validated());

        return redirect()
            ->back()
            ->with('status', trans('info.success'));
    }

    public function edit($id)
    {
        $result = $this->userLogic->edit($id);

        $user = $result['user'];
        $cities = $result['cities'];
        $roles = $result['roles'];

        return view('front.users.admin.edit', compact('user', 'roles', 'cities'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->userLogic->update($request->validated(), $id);

        return redirect()
            ->back()
            ->with('status', trans('info.success'));
    }
}
