<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id',
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

    public function executor(){

        return $this->hasMany(Executor::class);
    }

    public function city(){

        return $this->belongsTo(City::class,'parent_id', 'id') ;
    }

    public function parent(){

        return $this->belongsTo(City::class,'parent_id', 'id') ;
    }
}
