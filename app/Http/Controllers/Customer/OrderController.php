<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\CustomerOrderLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderLogic;

    public function __construct(CustomerOrderLogic $orderLogic)
    {
        $this->orderLogic = $orderLogic;
    }

    public function index()
    {
        $customer = Auth::user();
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/order.php')));

        return view('site.account.customer.orders.index', compact('customer', 'lang'));
    }

    public function list(Request $request)
    {
        $filter = \Request::input('filter', [
            'status_id' => $request['status_id'] ?? null,
            'updated_at' => [
                'start' => $request['start_date'] ?? null,
                'end' => $request['end_date'] ?? null,
            ],
        ]);

        $result = $this->orderLogic->list($request, $filter);
        $result_period = $this->orderLogic->sum_period($request);

        return response()->json([
            'all_count' => $result['all_count'],
            'orders' => $result['orders'],
            'sum_repair' => $result['sum_repair'],
            'sum_part' => $result['sum_part'],
            'year_sum_repair' => $result_period['year_sum_repair'],
            'year_sum_part' => $result_period['year_sum_part'],
            'month_sum_repair' => $result_period['month_sum_repair'],
            'month_sum_part' => $result_period['month_sum_part'],
            'week_sum_repair' => $result_period['week_sum_repair'],
            'week_sum_part' => $result_period['week_sum_part'],
        ]);
    }

}
