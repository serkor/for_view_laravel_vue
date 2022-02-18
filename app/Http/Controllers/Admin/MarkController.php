<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Marks\MarkStoreRequest;
use App\Http\Requests\Marks\MarkUpdateRequest;
use App\Logics\Repositories\MarkLogic;
use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    protected $markLogic;

    public function __construct(MarkLogic $markLogic)
    {
        $this->markLogic = $markLogic;
    }

    public function index()
    {
        $marks = $this->markLogic->all();

        return view('front.marks.index', compact('marks'));
    }

    public function store(MarkStoreRequest $request)
    {
        $this->markLogic->store($request->validated());

        return redirect()->route('marks.index')
            ->with('status', trans('info.success'));
    }

    public function create()
    {
        return view('front.marks.create');
    }

    public function edit($id)
    {
        $mark = $this->markLogic->edit($id);

        return view('front.marks.edit', compact('mark'));
    }

    public function update(MarkUpdateRequest $request, $id)
    {
        $this->markLogic->update($request->validated(), $id);

        return redirect()->route('marks.index')
            ->with('status', trans('info.success'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
        ]);

        $marks = Mark::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.marks.index', compact('marks'));
    }
}
