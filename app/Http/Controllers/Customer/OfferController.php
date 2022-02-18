<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\OfferLogic;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    protected $offerLogic;

    public function __construct(OfferLogic $offerLogic)
    {
        $this->offerLogic = $offerLogic;
    }

    public function list(Request $request)
    {
        $result = $this->offerLogic->listCustomer($request->all());

        return response()->json(['all_count' => $result['all_count'], 'offers' => $result['offers']]);
    }

    public function select(Request $request)
    {
        $result = $this->offerLogic->select($request->all());

        return response()->json($result);
    }

    public function unselect(Request $request)
    {
        $result = $this->offerLogic->unselect($request->all());

        return response()->json($result);
    }

}
