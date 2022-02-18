<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vin',
        'customer_id',
        'mark_id',
        'mark_model_id',
        'transmission_id',
        'year_id',
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

    public function customers(){

        return $this->belongsToMany(Customer::class);
    }

    public function mark(){

        return $this->belongsTo(Mark::class);
    }

    public function mark_model(){

        return $this->belongsTo(MarkModel::class);
    }

    public function transmission(){

        return $this->belongsTo(Transmission::class);
    }

    public function year(){

        return $this->belongsTo(Year::class);
    }
}
