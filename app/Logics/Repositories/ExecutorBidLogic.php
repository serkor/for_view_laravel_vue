<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\ExecutorBidLogicInterface;
use App\Models\Bid;
use App\Models\Category;
use App\Models\City;
use App\Models\File;

class ExecutorBidLogic implements ExecutorBidLogicInterface
{
    protected $bid;
    protected $bidCommentLogic;

    public function __construct(Bid $bid, BidCommentLogic $bidCommentLogic)
    {
        $this->bid = $bid;
        $this->bidCommentLogic = $bidCommentLogic;
    }

    public function index($customer)
    {
        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();

        $categories = Category::with('category')
            ->where('parent_id', '!=', 0)
            ->get();

        return [
            'cities' => $cities,
            'categories' => $categories,
        ];
    }

    public function count($request)
    {
        $open_count = count($this->bid
            ->whereNull('executor_id')
            ->whereDoesntHave('offers', function ($query) use ($request) {
                $query->where('executor_id', $request['executor_id']);
            })
//            ->orWhereDoesntHave('offers')
            ->whereIn('status_id', [1])
            ->get());

        $expected_count = count($this->bid
            ->whereNull('executor_id')
            ->whereHas('offers', function ($query) use ($request) {
                $query->where('executor_id', $request['executor_id']);
            })
            ->whereIn('status_id', [1])
            ->get());

        $selected_count = count($this->bid
            ->where('executor_id', $request['executor_id'])
            ->whereIn('status_id', [2, 6])
            ->get());

        return [
            'open_count' => $open_count,
            'expected_count' => $expected_count,
            'selected_count' => $selected_count,
        ];
    }

    public function list($request, $filter)
    {
        if ($request->tab == 'open') {
            $result = $this->tabOpen($request, $filter);
        }

        if ($request->tab == 'expected') {
            $result = $this->tabExpected($request, $filter);
        }

        if ($request->tab == 'selected') {
            $result = $this->tabSelected($request, $filter);
        }

        return [
            'all_count' => $result['all_count'],
            'bids' => $result['bids'],
        ];
    }

    public function tabOpen($request, $filter)
    {
        $bids = $this->bid
            ->with([
                'car.mark',
                'car.mark_model',
                'car.transmission',
                'car.year',
                'questions',
                'customer',
                'city',
                'status',
                'categories',
            ])
            ->whereNull('executor_id')
            ->whereDoesntHave('offers', function ($query) use ($request) {
                $query->where('executor_id', $request['executor_id']);
            })
//            ->orWhereDoesntHave('offers')
            ->whereIn('status_id', [1])
            ->orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function tabExpected($request, $filter)
    {
        $bids = $this->bid
            ->with([
                'car.mark',
                'car.mark_model',
                'car.transmission',
                'car.year',
                'questions',
                'customer',
                'city',
                'status',
                'categories',
            ])
            ->whereNull('executor_id')
            ->whereHas('offers', function ($query) use ($request) {
                $query->where('executor_id', $request['executor_id']);
            })
            ->whereIn('status_id', [1, 6])
            ->orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function tabSelected($request, $filter)
    {
        $bids = $this->bid
            ->with([
                'car.mark',
                'car.mark_model',
                'car.transmission',
                'car.year',
                'questions',
                'customer',
                'city',
                'status',
                'categories',
            ])
            ->where('executor_id', $request['executor_id'])
            ->whereIn('status_id', [2, 6])
            ->orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function show($id)
    {
        $bid = $this->bid
            ->with([
                'car.mark',
                'car.mark_model',
                'car.transmission',
                'car.year',
                'questions',
                'offers',
                'city',
                'status',
                'categories',
                'executor',
                'customer',
                'comments.user'
            ])
            ->findOrFail($id);

        $files = File::where('entity', 'bids')->where('item_id', $id)->get();

        return ['bid' => $bid, 'files' => $files];
    }

    public function update($request, $bid){

        return $bid->update([
            'status_id' => $request['status_id'],
        ]);
    }

}
