<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Aginev\SearchFilters\Filterable;

class Mark extends Model
{
    use Filterable;

    protected $table = 'marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function mark_models(){

        return $this->hasMany(MarkModel::class);
    }

    public function cars(){

        return $this->hasMany(Car::class);
    }

    public function setFilters()
    {
        $this->filter->like('name');
    }
}
