<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CustomerOrderLogicInterface;
use App\Models\Order;
use Carbon\Carbon;

class CustomerOrderLogic implements CustomerOrderLogicInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function list($request, $filter)
    {
        $orders = $this->order
            ->with([
                'car',
                'executor',
                'status',
            ])
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [3, 5, 4])
            ->orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(9);

        return [
            'sum_repair' => $orders->sum('sum_repair'),
            'sum_part' => $orders->sum('sum_part'),
            'all_count' => $orders->total(),
            'orders' => $orders,
        ];
    }

    public function sum_period($request)
    {
        $year = Carbon::now()->subYear(1)->format('Y-m-d');
        $month = Carbon::now()->subMonths(1)->format('Y-m-d');
        $week = Carbon::now()->subWeeks(1)->format('Y-m-d');

        $orders = $this->order
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [3])
            ->get();

        $year_sum_repair = $orders
            ->where('updated_at','>=', $year)
            ->sum('sum_repair');
        $year_sum_part = $orders
            ->where('updated_at','>=', $year)
            ->sum('sum_part');

        $month_sum_repair = $orders
            ->where('updated_at','>=', $month)
            ->sum('sum_repair');
        $month_sum_part = $orders
            ->where('updated_at','>=', $month)
            ->sum('sum_part');

        $week_sum_repair = $orders
            ->where('updated_at','>=', $week)
            ->sum('sum_repair');
        $week_sum_part = $orders
            ->where('updated_at','>=', $week)
            ->sum('sum_part');

        return [
            'year_sum_repair' => $year_sum_repair,
            'year_sum_part' => $year_sum_part,
            'month_sum_repair' => $month_sum_repair,
            'month_sum_part' => $month_sum_part,
            'week_sum_repair' => $week_sum_repair,
            'week_sum_part' => $week_sum_part,
        ];
    }
}
