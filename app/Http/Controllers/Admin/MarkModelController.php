<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkModels\MarkModelStoreRequest;
use App\Http\Requests\MarkModels\MarkModelUpdateRequest;
use App\Logics\Repositories\MarkModelLogic;
use App\Models\MarkModel;
use Illuminate\Http\Request;

class MarkModelController extends Controller
{
    protected $markModelLogic;

    public function __construct(MarkModelLogic $markModelLogic)
    {
        $this->markModelLogic = $markModelLogic;
    }

    public function index()
    {
        $mark_models= $this->markModelLogic->all();

        return view('front.mark_models.index', compact('mark_models'));
    }

    public function store(MarkModelStoreRequest $request)
    {
        $this->markModelLogic->store($request->validated());

        return redirect()->route('mark-models.index')
            ->with('status', trans('info.success'));
    }

    public function create()
    {
        $marks = $this->markModelLogic->create();

        return view('front.mark_models.create', compact('marks'));
    }

    public function edit($id)
    {
        $result = $this->markModelLogic->edit($id);

        $mark_model = $result['mark_model'];
        $marks = $result['marks'];

        return view('front.mark_models.edit', compact('mark_model', 'marks'));
    }

    public function update(MarkModelUpdateRequest $request, $id)
    {
        $this->markModelLogic->update($request->validated(), $id);

        return redirect()->route('mark-models.index')
            ->with('status', trans('info.success'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
        ]);

        $mark_models = MarkModel::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.mark_models.index', compact('mark_models'));
    }
}
