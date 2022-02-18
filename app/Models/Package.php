<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'days',
        'limit_offers',
    ];

    public function usesTimestamps()
    {
        return false;
    }

    public function executor() {

        return $this->belongsTo( Executor::class, 'executor_id', 'id');
    }

}
