<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Aginev\SearchFilters\Filterable;

class Category extends Model
{
    use Filterable;

    protected $table = 'categories';
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

	public function children() {

        return $this->hasMany(Category::class,'parent_id','id') ;
    }

    public function category(){

        return $this->belongsTo(Category::class,'parent_id', 'id') ;
    }

    public function executors(){

        return $this->belongsToMany(Executor::class);
    }

    public function bids()
    {
        return $this->belongsToMany(Bid::class);
    }

    public function setFilters()
    {
        $this->filter->like('name');
    }

}
