<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Aginev\SearchFilters\Filterable;

class Bid extends Model
{
    use Filterable;

    protected $table = 'bids';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'executor_id',
        'selection_date',
        'car_id',
        'city_id',
        'description',
        'desired_date',
        'status_id',
        'type',
        'sum_repair',
        'sum_part',
        'updated_at',
    ];

    public function customer(){

        return $this->belongsTo(Customer::class);
    }

    public function executor(){

        return $this->belongsTo(Executor::class);
    }

    public function status(){

        return $this->belongsTo(BidStatus::class);
    }

    public function car(){

        return $this->belongsTo(Car::class);
    }

    public function city(){

        return $this->belongsTo(City::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function offers() {

        return $this->hasMany(Offer::class);
    }

    public function questions() {

        return $this->hasMany(BidQuestion::class);
    }

    public function comments() {

        return $this->hasMany(BidComment::class);
    }

    public function setFilters()
    {
        $this->filter
            ->equal('id')
            ->equal('city_id')
            ->date('desired_date')
            ->equal('type')

            ->custom('category_id', function ($query, $key, $value) {
                $query->whereHas('categories', function ($query) use ($value) {
                    if (!empty($value)) {
                        $query->whereIn('category_id', [$value]);
                    }
                });
            });

//            ->custom('column', function($query, $column, $value) {
//                // $query - instance of Illuminate\Database\Eloquent\Builder
//                // $column - the string passed as first argument
//                // $value - the filter value if exists and not empty
//            }, function ($by, $dir, $query) {
//                // Not required and can be applied to any other filter method
//
//                // $by - order by field
//                // $dir - order direction
//                // $query - instance of Illuminate\Database\Eloquent\Builder
//            })
//            ->equal('column')                  // column = filter_value
//            ->distinct('column')               // column <> filter_value
//            ->greaterThan('column')            // column > filter_value
//            ->greaterOrEqualThan('column')     // column >= filter_value
//            ->lessThan('column')               // column < filter_value
//            ->lessOrEqualThan('column')        // column <= filter_value
//            ->like('column')                   // column LIKE '%filter_value%'
//            ->llike('column')                  // column LIKE '%filter_value'
//            ->rlike('column')                  // column LIKE 'filter_value%'
//            ->between('column')                // column BETWEEN filter_value[0] AND filter_value[1]
//            ->notBetween('column')             // column NOT BETWEEN filter_value[0] AND filter_value[1]
//            ->in('column')                     // column IN (filter_value[0], ..., filter_value[N])
//            ->notIn('column')                  // column NOT IN (filter_value[0], ..., filter_value[N])
//            ->null('column')                   // column IS NULL
//            ->notNull('column')                // column IS NOT NULL
//            ->date('column')                   // column DATE(column) = filter_value
//            ->dateBetween('column');           // column DATE(column) BETWEEN filter_value[0] AND filter_value[1]
    }
}
