<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidStatus extends Model
{
    protected $table = 'bid_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role'
    ];

    /**
     * Determine if the model uses timestamps.
     *
     * @return bool
     */
    public function usesTimestamps()
    {
        return false;
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
