<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Transmissions\TransmissionStoreRequest;
use App\Http\Requests\Transmissions\TransmissionUpdateRequest;
use App\Logics\Repositories\TransmissionLogic;
use App\Http\Controllers\Controller;

class TransmissionController extends Controller
{
    protected $transmissionLogic;

    public function __construct(TransmissionLogic $transmissionLogic)
    {
        $this->transmissionLogic = $transmissionLogic;
    }

    public function index()
    {
        $transmissions = $this->transmissionLogic->all();

        return view('front.transmissions.index', compact('transmissions'));
    }

    public function store(TransmissionStoreRequest $request)
    {
        $this->transmissionLogic->store($request->validated());

        return redirect()->route('marks.index')
            ->with('status', trans('info.success'));
    }

    public function create()
    {
        return view('front.transmissions.create');
    }

    public function edit($id)
    {
        $transmission = $this->transmissionLogic->edit($id);

        return view('front.transmissions.edit', compact('transmission'));
    }

    public function update(TransmissionUpdateRequest $request, $id)
    {
        $this->transmissionLogic->update($request->validated(), $id);

        return redirect()->route('transmissions.index')
            ->with('status', trans('info.success'));
    }
}
