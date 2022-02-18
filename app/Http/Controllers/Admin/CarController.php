<?php

namespace App\Http\Controllers\Admin;

use App\Logics\Repositories\CarLogic;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    protected $carLogic;

    public function __construct(CarLogic $carLogic)
    {
        $this->carLogic = $carLogic;
    }

    public function all()
    {
        $cars = $this->carLogic->all();

        return view('front.cars.index', compact('cars'));
    }

}
