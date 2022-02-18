<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CarLogicInterface;
use App\Models\Car;
use App\Models\Mark;
use App\Models\MarkModel;
use App\Models\Transmission;
use App\Models\Year;

class CarLogic implements CarLogicInterface
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function all()
    {
        return $this->car->paginate(20);
    }

    public function index()
    {
        $marks = Mark::all();
        $mark_models = MarkModel::with('mark')->get();
        $transmissions = Transmission::all();
        $years = Year::all();

        return [
            'marks' => $marks,
            'mark_models' => $mark_models,
            'transmissions' => $transmissions,
            'years' => $years,
        ];
    }

    public function list($request)
    {
        $cars = Car::where('customer_id', $request['customer_id'])->paginate(9);

        return [
            'all_count' => $cars->total(),
            'cars' => $cars,
        ];
    }

    public function list_update($request)
    {
        $cars = Car::where('customer_id', $request['customer_id'])
            ->with('mark')
            ->with('mark_model')
            ->get();

        return [
            'cars' => $cars,
        ];
    }

    public function store($request)
    {
        return $this->car->create($request);
    }

//    public function update($request, $id)
//    {
//        $car = $this->car->findOrFail($id);
//        $car->update($request);
//    }
}
