<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable{

    use Notifiable;

    protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'type',
        'name',
        'surname',
        'phone',
        'image',
        'email',
        'get_email',
        'password',
    ];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
        'rate',
        'package_id',
        'show_map',
        'description',
        'work_hours',
        'year_experience',
        'company_type',
        'company_name',
        'company_address',
        'company_requisites',
        'company_contact',
        'show_profile',
        'verified',
        'password',
        'remember_token',
        'password_confirmation',
	];

    public function verified()
    {
        return $this->verified == true;
    }

    public function files() {

        return $this->hasMany( File::class, 'user_id', 'id' );
    }

    public function reviews() {

        return $this->hasMany(Review::class, 'customer_id', 'id') ;
    }

    public function roles() {

        return $this->belongsToMany( Role::class, 'role_user', 'user_id', 'role_id' );
    }

    public function cars(){

        return $this->belongsToMany(Car::class);
    }

    public function bids() {

        return $this->hasMany(Bid::class, 'customer_id', 'id') ;
    }

}
