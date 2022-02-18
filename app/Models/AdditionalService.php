<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    protected $table = 'additional_services';
    protected $fillable = [
        'name',
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

    public function executors(){

        return $this->belongsToMany(Executor::class);
    }
}
