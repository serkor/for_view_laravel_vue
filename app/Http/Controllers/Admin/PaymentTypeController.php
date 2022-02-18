<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTypes\PaymentTypeStoreRequest;
use App\Http\Requests\PaymentTypes\PaymentTypeUpdateRequest;
use App\Logics\Repositories\PaymentTypeLogic;

class PaymentTypeController extends Controller
{
    protected $paymentTypeLogic;

    public function __construct(PaymentTypeLogic $paymentTypeLogic)
    {
        $this->paymentTypeLogic = $paymentTypeLogic;
    }

    public function index()
    {
        $payment_types = $this->paymentTypeLogic->all();

        return view('front.payment_types.index', compact('payment_types'));
    }

    public function store(PaymentTypeStoreRequest $request)
    {
        $this->paymentTypeLogic->store($request->validated());

        return redirect()->back()->with('status', trans('info.success'));
    }

    public function create()
    {
        return view('front.payment_types.create');
    }

    public function edit($id)
    {
        $payment_type = $this->paymentTypeLogic->edit($id);

        return view('front.payment_types.edit', compact('payment_type'));
    }

    public function update(PaymentTypeUpdateRequest $request, $id)
    {
        $this->paymentTypeLogic->update($request->validated(), $id);

        return redirect()->route('payment_types.index')
            ->with('status', trans('info.success'));
    }
}
