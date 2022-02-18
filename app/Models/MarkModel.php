<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Aginev\SearchFilters\Filterable;

class MarkModel extends Model
{
    use Filterable;

    protected $table = 'mark_models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mark_id'
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

    public function mark(){

        return $this->belongsTo(Mark::class,'mark_id', 'id') ;
    }

    public function cars(){

        return $this->hasMany(Car::class);
    }

    public function setFilters()
    {
        $this->filter->like('name');
    }
}
