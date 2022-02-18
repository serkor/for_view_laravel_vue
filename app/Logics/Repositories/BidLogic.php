<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\BidLogicInterface;
use App\Models\Bid;

class BidLogic implements BidLogicInterface
{
    protected $bid;
    protected $fileLogic;

    public function __construct(Bid $bid, FileLogic $fileLogic)
    {
        $this->bid = $bid;
        $this->fileLogic = $fileLogic;
    }

    public function all()
    {
        return $this->bid->paginate(20);
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
            ->findOrFail($id);

        return ['bid' => $bid];
    }

    public function update($request)
    {
        $bid = $this->bid->findOrFail($request['id']);
        return $bid->update([
            'status_id' => $request['status_id']
        ]);
    }

}
