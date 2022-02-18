<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CustomerBidLogicInterface;
use App\Models\Bid;
use App\Models\Car;
use App\Models\Category;
use App\Models\City;
use App\Models\File;
use App\Models\Mark;
use App\Models\MarkModel;
use App\Models\Transmission;
use App\Models\Year;

class CustomerBidLogic implements CustomerBidLogicInterface
{
    protected $bid;
    protected $fileLogic;

    public function __construct(Bid $bid, FileLogic $fileLogic)
    {
        $this->bid = $bid;
        $this->fileLogic = $fileLogic;
    }

    public function index($customer)
    {
        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();

        $cars = Car::where('customer_id', $customer->id)
            ->with('mark')
            ->with('mark_model')
            ->get();

        $categories = Category::with('category')
            ->where('parent_id', '!=', 0)
            ->get();

        $marks = Mark::all();
        $mark_models = MarkModel::with('mark')->get();
        $transmissions = Transmission::all();
        $years = Year::all();

        return [
            'cars' => $cars,
            'cities' => $cities,
            'categories' => $categories,
            'marks' => $marks,
            'mark_models' => $mark_models,
            'transmissions' => $transmissions,
            'years' => $years,
        ];
    }

    public function list($request)
    {
        if ($request->tab == 'open') {
            $result = $this->tabOpen($request);
        }

        if ($request->tab == 'confirmed') {
            $result = $this->tabConfirmed($request);
        }

        if ($request->tab == 'canceled') {
            $result = $this->tabCanceled($request);
        }

        return [
            'all_count' => $result['all_count'],
            'bids' => $result['bids'],
        ];
    }

    public function count($request)
    {
        $open_count = count($this->bid
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [1])
            ->get());

        $confirmed_count = count($this->bid
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [2, 6])
            ->get());

        $canceled_count = count($this->bid
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [4])
            ->get());

        return [
            'open_count' => $open_count,
            'confirmed_count' => $confirmed_count,
            'canceled_count' => $canceled_count,
        ];
    }

    public function tabOpen($request)
    {
        $bids = $this->bid
            ->with('car.mark')
            ->with('car.mark_model')
            ->with('car.transmission')
            ->with('car.year')
            ->with('questions')
            ->with('executor')
            ->with('offers')
            ->with('city')
            ->with('status')
            ->with('categories')
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [1])
            ->orderBy('id', 'desc')
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function tabConfirmed($request)
    {
        $bids = $this->bid
            ->with('car.mark')
            ->with('car.mark_model')
            ->with('car.transmission')
            ->with('car.year')
            ->with('questions')
            ->with('executor')
            ->with('offers')
            ->with('city')
            ->with('status')
            ->with('categories')
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [2, 6])
            ->orderBy('id', 'desc')
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function tabCanceled($request)
    {
        $bids = $this->bid
            ->with('car.mark')
            ->with('car.mark_model')
            ->with('car.transmission')
            ->with('car.year')
            ->with('questions')
            ->with('executor')
            ->with('offers')
            ->with('city')
            ->with('status')
            ->with('categories')
            ->where('customer_id', $request['customer_id'])
            ->whereIn('status_id', [4])
            ->orderBy('id', 'desc')
            ->paginate(9);

        return [
            'all_count' => $bids->total(),
            'bids' => $bids,
        ];
    }

    public function store($request)
    {
        $bid = $this->bid->fill($request);
        $bid->save();
        $bid->categories()->sync(explode(',', $request['category_ids']));

        if ($request['file'] != 'null') {
            $this->fileLogic->UploadBidFile($request['file'], $request['customer_id'], $bid);
        }
    }

    public function show($id)
    {
        $bid = $this->bid
            ->with('car.mark')
            ->with('car.mark_model')
            ->with('car.transmission')
            ->with('car.year')
            ->with('questions')
            ->with('offers')
            ->with('city')
            ->with('status')
            ->with('categories')
            ->with('executor')
            ->with('customer')
            ->with('comments.user')
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
