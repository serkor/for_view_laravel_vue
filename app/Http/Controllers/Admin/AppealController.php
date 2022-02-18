<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Appeals\AppealStoreRequest;
use App\Http\Requests\Appeals\AppealUpdateRequest;
use App\Http\Controllers\Controller;
use App\Logics\Repositories\AppealLogic;

class AppealController extends Controller
{
    protected $appealLogic;

    public function __construct(AppealLogic $appealLogic)
    {
        $this->appealLogic = $appealLogic;
    }

    public function index()
    {
        $appeals = $this->appealLogic->all();

        return view('front.appeals.index', compact('appeals'));
    }

    public function store(AppealStoreRequest $request)
    {
        $this->appealLogic->store($request->validated());

        return redirect()->back()->with('status', trans('page.contacts.success_contact'));
    }

    public function edit($id)
    {
        $appeal = $this->appealLogic->edit($id);

        return view('front.appeals.edit', compact('appeal'));
    }

    public function update(AppealUpdateRequest $request, $id)
    {
        $this->appealLogic->update($request->validated(), $id);

        return redirect()->route('appeals.index')
            ->with('status', trans('info.success'));
    }
}
