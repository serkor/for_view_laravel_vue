<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\Executor\UpdateExecutorRequest;
use App\Http\Controllers\Controller;
use App\Logics\Repositories\ExecutorLogic;
use App\Models\User;
use Illuminate\Http\Request;

class ExecutorController extends Controller
{

    protected $executorLogic;

    public function __construct(ExecutorLogic $executorLogic)
    {
        $this->executorLogic = $executorLogic;
    }

    public function index()
    {
        $executors = $this->executorLogic->index();

        return view('front.users.executor.index', compact('executors'));
    }

    public function edit($id)
    {
        $result = $this->executorLogic->edit($id);
        $executor = $result['executor'];
        $cities = $result['cities'];
        $roles = $result['roles'];
        $files = $result['files'];
        $categories = $result['categories'];
        $executor_categories = $result['executor_categories'];
        $payment_types = $result['payment_types'];
        $executor_payment_types = $result['executor_payment_types'];
        $additional_services = $result['additional_services'];
        $executor_additional_services = $result['executor_additional_services'];

        return view('front.users.executor.edit', compact('executor',
            'roles', 'cities', 'categories', 'executor_categories',
            'payment_types', 'executor_payment_types', 'additional_services',
            'executor_additional_services', 'files'));
    }

    public function update(UpdateExecutorRequest $request, $id)
    {
        $this->executorLogic->update($request->validated(), $id);

        return redirect()
            ->back()
            ->with('status', trans('info.success'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
            'phone' => $request['phone'] ?? null,
            'email' => $request['email'] ?? null,
            'verified' => $request['verified'] ?? null,
        ]);

        $executors = User::orderBy('id', 'desc')
            ->where('type', 2)
            ->filter($filter)
            ->paginate(20);

        return view('front.users.executor.index', compact('executors'));
    }
}
