<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Years\PaymentTypeStoreRequest;
use App\Http\Requests\Years\PaymentTypesUpdateRequest;
use App\Logics\Repositories\YearLogic;

class YearController extends Controller
{
    protected $yearLogic;

    public function __construct(YearLogic $yearLogic)
    {
        $this->yearLogic = $yearLogic;
    }

    public function index()
    {
        $years = $this->yearLogic->all();

        return view('front.years.index', compact('years'));
    }

    public function store(PaymentTypeStoreRequest $request)
    {
        $this->yearLogic->store($request->validated());

        return redirect()->back()->with('status', trans('info.success'));
    }

    public function create()
    {
        return view('front.years.create');
    }

    public function edit($id)
    {
        $year = $this->yearLogic->edit($id);

        return view('front.years.edit', compact('year'));
    }

    public function update(PaymentTypesUpdateRequest $request, $id)
    {
        $this->yearLogic->update($request->validated(), $id);

        return redirect()->route('years.index')
            ->with('status', trans('info.success'));
    }
}
