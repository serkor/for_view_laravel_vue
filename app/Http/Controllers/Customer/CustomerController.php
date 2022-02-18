<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Customer\UpdateCustomerAccountRequest;
use App\Http\Requests\Users\Customer\UpdateCustomerSettingRequest;
use App\Logics\Repositories\CustomerLogic;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerLogic;

    public function __construct(CustomerLogic $customerLogic)
    {
        $this->customerLogic = $customerLogic;
    }

    public function profile()
    {
        $result = $this->customerLogic->profile(Auth::id());

        $customer = $result['customer'];

        return view('site.account.customer.profile', compact('customer'));
    }

    public function update_account(UpdateCustomerAccountRequest $request, $id)
    {
        $this->customerLogic->update_account($request->validated(), $id);

        return redirect()->back()->with('status', trans('info.success'));
    }

    public function update_settings(UpdateCustomerSettingRequest $request, $id)
    {
        $this->customerLogic->update_settings($request->validated(), $id);

        return redirect()->back()->with('status', trans('info.success'));
    }

}
