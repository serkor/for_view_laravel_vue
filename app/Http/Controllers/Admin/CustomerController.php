<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\Customer\StoreCustomerRequest;
use App\Http\Requests\Users\Customer\UpdateCustomerRequest;
use App\Logics\Repositories\CustomerLogic;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customerLogic;

    public function __construct(CustomerLogic $customerLogic)
    {
        $this->customerLogic = $customerLogic;
    }

    public function index()
    {
        $customers = $this->customerLogic->index();

        return view('front.users.customer.index', compact('customers'));
    }

    public function edit($id)
    {
        $result = $this->customerLogic->edit($id);

        $customer = $result['customer'];
        $cities = $result['cities'];
        $roles = $result['roles'];

        return view('front.users.customer.edit', compact('customer', 'roles', 'cities'));
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $this->customerLogic->update($request->validated(), $id);

        return redirect()
            ->back()
            ->with('status', trans('info.success'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
            'surname' => $request['surname'] ?? null,
            'phone' => $request['phone'] ?? null,
            'email' => $request['email'] ?? null,
        ]);

        $customers = User::orderBy('id', 'desc')
            ->where('type', 3)
            ->filter($filter)
            ->paginate(20);

        return view('front.users.customer.index', compact('customers'));
    }
}
