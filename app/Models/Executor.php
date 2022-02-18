<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Aginev\SearchFilters\Filterable;

class Executor extends Authenticatable {

    use Notifiable, Filterable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'phone',
        'image',
        'email',
        'get_email',
        'password',
        'city_id',
        'verified',
        'address',
        'package_id',
        'description',
        'work_hours',
        'year_experience',
        'company_type',
        'company_name',
        'company_address',
        'company_requisites',
        'company_contact',
        'show_profile',
        'show_map',
        'rate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'surname',
        'password',
        'remember_token',
        'password_confirmation',
    ];

    public function verified()
    {
        return $this->verified == true;
    }

    public function files()
    {

        return $this->hasMany(File::class, 'user_id', 'id');
    }

    public function reviews()
    {

        return $this->hasMany(Review::class, 'executor_id', 'id');
    }

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function city()
    {

        return $this->belongsTo(City::class);
    }

    public function categories()
    {

        return $this->belongsToMany(Category::class);
    }

    public function payment_types(){

        return $this->belongsToMany(PaymentType::class);
    }

    public function additional_services(){

        return $this->belongsToMany(AdditionalService::class);
    }

    public function bids() {

        return $this->hasMany(Bid::class, 'executor_id', 'id') ;
    }

    public function offers() {

        return $this->hasMany(Offer::class, 'executor_id', 'id');
    }

    public function offer_templates() {

        return $this->hasMany(OfferTemplate::class);
    }

    public function payments() {

        return $this->hasMany(Payment::class, 'executor_id', 'id') ;
    }

    public function setFilters()
    {
        $this->filter
            ->like('name')
            ->equal('city_id')
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
