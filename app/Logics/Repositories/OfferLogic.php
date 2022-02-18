<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\OfferLogicInterface;
use App\Models\Bid;
use App\Models\Offer;
use App\Notifications\Customer\CustomerNewOfferNotification;
use App\Notifications\Executor\ExecutorChangeStatusOfferNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OfferLogic implements OfferLogicInterface
{
    protected $offer;
    protected $bid;

    public function __construct(Offer $offer, Bid $bid)
    {
        $this->offer = $offer;
        $this->bid = $bid;
    }

    public function listCustomer($request)
    {
        $all_count = count($this->offer
            ->where('bid_id', $request['bid_id'])
            ->get());

        $offers = $this->offer
            ->where('bid_id', $request['bid_id'])
            ->with('executor')
            ->paginate(9);

        return [
            'all_count' => $all_count,
            'offers' => $offers,
        ];
    }

    public function listExecutor($request)
    {
        $all_count = count($this->offer
            ->where('bid_id', $request['bid_id'])
            ->get());

        $offers = $this->offer
            ->where('bid_id', $request['bid_id'])
            ->where('executor_id', $request['executor_id'])
            ->with('executor')
            ->paginate(9);

        return [
            'all_count' => $all_count,
            'offers' => $offers,
        ];
    }

    public function store($request)
    {
        if (check_count_add_offers($request['executor_id'])) {
            $offer = $this->offer->create($request);
            $this->add_executor_offer($offer);
            get_user($offer->bid->customer_id)
                ->notify(new CustomerNewOfferNotification($offer));
            return true;
        } else {
            return false;
        }
    }

    public function add_executor_offer($offer)
    {
        DB::table('executor_offers')->insert([
            'bid_id' => $offer->bid_id,
            'offer_id' => $offer->id,
            'executor_id' => $offer->executor_id,
            'created_at' => $offer->created_at,
        ]);
    }

    public function select($request)
    {
        $offer = $this->offer->findOrFail($request['offer_id']);
        $bid = $this->bid->findOrFail($request['bid_id']);

        if ($this->validate_select($bid, $offer)) {

            $offer->update([
                'select' => 1
            ]);

            $bid->update([
                'executor_id' => $offer->executor_id,
                'status_id' => 2,
                'sum_repair' => $offer->sum_repair,
                'sum_part' => $offer->sum_part,
                'selection_date' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()
            ]);

            get_user($offer->executor_id)
                ->notify(new ExecutorChangeStatusOfferNotification($offer));

            return true;
        } else {
            return false;
        }
    }

    public function unselect($request)
    {
        $offer = $this->offer->findOrFail($request['offer_id']);
        $bid = $this->bid->findOrFail($request['bid_id']);

        if (!$this->validate_select($bid, $offer)) {

            $offer->update([
                'select' => 0
            ]);

            $bid->update([
                'executor_id' => null,
                'status_id' => 1,
                'sum_repair' => 0.00,
                'sum_part' => 0.00,
                'selection_date' => null,
                'updated_at' => Carbon::now()
            ]);

            get_user($offer->executor_id)
                ->notify(new ExecutorChangeStatusOfferNotification($offer));

            return true;
        } else {
            return false;
        }
    }

    public function validate_select($bid, $offer)
    {
        $offers = $this->offer
            ->where('bid_id', $bid->id)
            ->where('select', 1)->get();

        if ($offer->select || (count($offers) > 0)) {
            return false;
        } else {
            return true;
        }
    }

}
