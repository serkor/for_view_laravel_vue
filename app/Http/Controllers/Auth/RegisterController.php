<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\Customer;
use App\Models\Executor;
use App\Http\Controllers\Controller;
use App\Notifications\Admin\NewUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/auth.php')));

        return view('auth.register', compact('cities', 'lang'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['role_id'] == 2){
            return Validator::make($data, [
                'role_id' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'city_id' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        if($data['role_id'] == 3){
            return Validator::make($data, [
                'role_id' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['role_id'] == 1){
            return abort('500');
        }

        if($data['role_id'] == 2){
            $user = Executor::create([
                'type' => 2,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'city_id' => $data['city_id'] ?? NULL,
                'package_id' => 1,
                'password' => Hash::make($data['password']),
            ]);
        }

        if($data['role_id'] == 3){
            $user = Customer::create([
                'type' => 3,
                'name' => $data['name'],
                'surname' => $data['surname'] ?? NULL,
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }

        $user->roles()->attach($data['role_id'], ['user_id' => $user->id]);

        Notification::send(get_list_admin(), new NewUserNotification($user));

        return $user;
    }
}
