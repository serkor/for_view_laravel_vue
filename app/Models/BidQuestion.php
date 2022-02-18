<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidQuestion extends Model
{
    protected $table = 'bid_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'executor_id',
        'customer_id',
        'bid_id',
        'text',
        'type',
        'created_at',
        'updated_at',
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function customer(){

        return $this->belongsTo(Customer::class);
    }

    public function executor(){

        return $this->belongsTo(Executor::class);
    }
}
