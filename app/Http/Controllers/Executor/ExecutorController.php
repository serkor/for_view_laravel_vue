<?php

namespace App\Http\Controllers\Executor;

use App\Http\Requests\Users\Executor\UpdateExecutorAccountRequest;
use App\Http\Requests\Users\Executor\UpdateExecutorSettingRequest;
use App\Logics\Repositories\ExecutorLogic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ExecutorController extends Controller
{
    protected $executorLogic;

    public function __construct(ExecutorLogic $executorLogic)
    {
        $this->executorLogic = $executorLogic;
    }

    public function profile()
    {
        $result = $this->executorLogic->profile(Auth::id());
        $executor = $result['executor'];
        $files = $result['files'];
        $cities = $result['cities'];
        $categories = $result['categories'];
        $executor_categories = $result['executor_categories'];
        $payment_types = $result['payment_types'];
        $executor_payment_types = $result['executor_payment_types'];
        $additional_services = $result['additional_services'];
        $executor_additional_services = $result['executor_additional_services'];

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/executor.php')));

        return view('site.account.executor.profile', compact('cities', 'executor',
            'categories', 'executor_categories', 'payment_types', 'executor_payment_types', 'additional_services',
            'executor_additional_services', 'lang', 'files'));
    }

    public function show($id)
    {
        $result = $this->executorLogic->show($id);
        $executor = $result['executor'];
        $favorites = collect($result['favorites']);

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/executor.php')));

        return view('site.account.executor.public_profile', compact('executor', 'favorites', 'lang'));
    }

    public function update_account(UpdateExecutorAccountRequest $request, $id)
    {
        $this->executorLogic->update_account($request->validated(), $id);

        return back()->with('status', trans('info.success'));
    }

    public function update_settings(UpdateExecutorSettingRequest $request, $id)
    {
        $this->executorLogic->update_settings($request->validated(), $id);

        return back()->with('status', trans('info.success'));
    }

}
