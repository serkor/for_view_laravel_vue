<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Aginev\SearchFilters\Filterable;

class User extends Authenticatable {

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
        'surname',
        'phone',
        'image',
        'email',
        'verified',
        'get_email',
        'password',
    ];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'password_confirmation',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

    public function routeNotificationForMail($notification = null)
    {
        if ($this->get_email == 'on') {
            return $this->email;
        }
        return null;
    }

    public function verified()
    {
        return $this->verified == true;
    }

    public function roles() {

		return $this->belongsToMany( Role::class, 'role_user' );
	}

    public function nameRole() {

        return $this->roles->pluck( 'description' )[0];
    }

	public function isAdmin() {

		$array = $this->roles->pluck( 'name' )->toArray();

		return in_array( 'admin', $array );
	}

	public function isExecutor() {

		$array = $this->roles->pluck( 'name' )->toArray();

		return in_array( 'executor', $array );
	}

	public function isCustomer() {

		$array = $this->roles->pluck( 'name' )->toArray();

		return in_array( 'customer', $array );
	}

	public function files() {

        return $this->hasMany( File::class, 'user_id', 'id' );
	}

//    public function reminders() {
//
//        return $this->hasMany(Reminder::class) ;
//    }

    public function setFilters()
    {
        $this->filter->like('name')->like('surname')->like('phone')->like('email')->equal('verified');
    }

}
