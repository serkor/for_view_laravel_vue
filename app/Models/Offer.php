<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'executor_id',
        'select',
        'bid_id',
        'sum_repair',
        'sum_part',
        'number_hours',
        'renovation_date',
        'description',
        'created_at',
        'updated_at',
    ];

    public function bid() {

        return $this->belongsTo(Bid::class);
    }

    public function executor(){

        return $this->belongsTo(Executor::class);
    }
}
