<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'executor_id',
        'customer_id',
        'rate',
        'public'
    ];

    public function executor() {

        return $this->belongsTo( Executor::class, 'executor_id', 'id');
    }

    public function customer() {

        return $this->belongsTo( Customer::class, 'customer_id', 'id');
    }
}
