<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\Cars\CarStoreRequest;
use App\Http\Requests\Cars\CarUpdateRequest;
use App\Logics\Repositories\CarLogic;
use App\Http\Controllers\Controller;
use App\Logics\Repositories\MarkModelLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    protected $carLogic;
    protected $mark_modelLogic;

    public function __construct(CarLogic $carLogic, MarkModelLogic $mark_modelLogic)
    {
        $this->carLogic = $carLogic;
        $this->mark_modelLogic = $mark_modelLogic;
    }

    public function index()
    {
        $result = $this->carLogic->index();
        $customer = Auth::user();
        $marks = $result['marks'];
        $mark_models = $result['mark_models'];
        $transmissions = $result['transmissions'];
        $years = $result['years'];

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/car.php')));

        return view('site.account.customer.cars',
            compact('marks', 'mark_models', 'transmissions', 'years', 'customer', 'lang'));
    }

    public function list(Request $request){

        $result = $this->carLogic->list($request);

        return response()->json(['all_count' => $result['all_count'], 'cars' => $result['cars']]);
    }

    public function list_update(Request $request){

        $result = $this->carLogic->list_update($request);

        return response()->json(['cars' => $result['cars']]);
    }

    public function store(CarStoreRequest $request)
    {
        $result = $this->carLogic->store($request->validated());

        return response()->json(['car' => $result, trans('info.success')] , 200);
    }

    public function get_mark_model(Request $request)
    {
        $result = $this->mark_modelLogic->get_list($request['id']);

        return response()->json($result , 200);
    }

//    public function update(CarUpdateRequest $request, $id)
//    {
//        $this->carLogic->update($request->validated(), $id);
//
//        return redirect()->route('cars.index')
//            ->with('status', trans('info.success'));
//    }
}
