<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdditionalServices\AdditionalServiceStoreRequest;
use App\Http\Requests\AdditionalServices\AdditionalServiceUpdateRequest;
use App\Logics\Repositories\AdditionalServiceLogic;

class AdditionalServiceController extends Controller
{
    protected $additionalServiceLogic;

    public function __construct(AdditionalServiceLogic $additionalServiceLogic)
    {
        $this->additionalServiceLogic = $additionalServiceLogic;
    }

    public function index()
    {
        $additional_services = $this->additionalServiceLogic->all();

        return view('front.additional_services.index', compact('additional_services'));
    }

    public function store(AdditionalServiceStoreRequest $request)
    {
        $this->additionalServiceLogic->store($request->validated());

        return redirect()->back()->with('status', trans('info.success'));
    }

    public function create()
    {
        return view('front.additional_services.create');
    }

    public function edit($id)
    {
        $additional_service = $this->additionalServiceLogic->edit($id);

        return view('front.additional_services.edit', compact('additional_service'));
    }

    public function update(AdditionalServiceUpdateRequest $request, $id)
    {
        $this->additionalServiceLogic->update($request->validated(), $id);

        return redirect()->route('additional_services.index')
            ->with('status', trans('info.success'));
    }
}
