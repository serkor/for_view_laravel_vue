<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\ExecutorLogicInterface;
use App\Models\AdditionalService;
use App\Models\Category;
use App\Models\City;
use App\Models\Executor;
use App\Models\File;
use App\Models\PaymentType;
use App\Models\Role;
use App\Notifications\Executor\ExecutorIsVerifiedNotification;
use Session;

class ExecutorLogic implements ExecutorLogicInterface
{
    protected $executor;
    protected $fileLogic;
    protected $favoriteLogic;

    public function __construct(Executor $executor, FileLogic $fileLogic, FavoriteLogic $favoriteLogic)
    {
        $this->executor = $executor;
        $this->fileLogic = $fileLogic;
        $this->favoriteLogic = $favoriteLogic;
    }

    public function index()
    {
        return $this->executor->whereHas('roles', function ($role) {
            $role->where('name', 'like', 'executor');
        })->paginate(10);
    }

    public function create()
    {
        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();

        $roles = Role::where('id', 1)->pluck('name', 'id');

        return ['cities' => $cities, 'roles' => $roles];
    }

    public function store($request)
    {
        $this->executor->create($request)->roles()->sync($request['role_id']);
    }

    public function edit($id)
    {
        $executor = $this->executor->findOrFail($id);

        $files = File::where('entity', 'users')
            ->where('item_id', $executor->id)
            ->get();

        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();

        $categories = Category::with('category')
            ->where('parent_id', '!=', 0)
            ->get();

        $executor_categories = $executor->categories;

        $payment_types = PaymentType::all();
        $executor_payment_types = $executor->payment_types;

        $additional_services = AdditionalService::all();
        $executor_additional_services = $executor->additional_services;

        $roles = Role::all()->pluck('name', 'id');

        return ['executor' => $executor, 'cities' => $cities, 'roles' => $roles, 'categories' => $categories,
            'executor_categories' => $executor_categories, 'payment_types' => $payment_types,
            'executor_payment_types' => $executor_payment_types, 'additional_services' => $additional_services,
            'executor_additional_services' => $executor_additional_services,
            'files' => $files,
        ];
    }

    public function update($request, $id)
    {
        $executor = $this->executor->findOrFail($id);

        $this->change_verified($executor, $request);

        $executor->update($request);

        if (!empty($request['image'])) {
            $image_name = $this->fileLogic->UploadLogo($request['image']);
            $executor->update(['image' => $image_name]);
        }

        if (!empty($request['files'])) {
            $this->fileLogic->UploadFilesAccount($request['files'], $id);
        }

        $executor->roles()->sync(2);

        if (!empty($request['category_ids'])) {
            $executor->categories()
                ->sync(explode(',', $request['category_ids']));
        }

        if (!empty($request['payment_type_ids'])) {
            $executor->payment_types()
                ->sync(explode(',', $request['payment_type_ids']));
        }

        if (!empty($request['additional_service_ids'])) {
            $executor->additional_services()
                ->sync(explode(',', $request['additional_service_ids']));
        }
    }

    public function profile($id)
    {
        $executor = $this->executor->findOrFail($id);
        $files = File::where('entity', 'users')
            ->where('item_id', $executor->id)
            ->get();
        $categories = Category::with('category')
            ->where('parent_id', '!=', 0)
            ->get();
        $cities = City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();
        $executor_categories = $executor->categories;

        $payment_types = PaymentType::all();
        $executor_payment_types = $executor->payment_types;

        $additional_services = AdditionalService::all();
        $executor_additional_services = $executor->additional_services;

        return [
            'cities' => $cities, 'executor' => $executor,
            'categories' => $categories,
            'files' => $files,
            'executor_categories' => $executor_categories,
            'payment_types' => $payment_types,
            'executor_payment_types' => $executor_payment_types,
            'additional_services' => $additional_services,
            'executor_additional_services' => $executor_additional_services,
        ];
    }

    public function show($id)
    {
        $executor = $this->executor->with('reviews')->findOrFail($id);

        $result = $this->favoriteLogic->query_all_list();

        return [
            'favorites' => $result['favorites'],
            'executor' => $executor,
            'all_count' => $result['all_count']
        ];

    }

    public function update_account($request, $id)
    {
        $executor = $this->executor->findOrFail($id);

        $executor->update($request);

        if (!empty($request['image'])) {
            $image_name = $this->fileLogic->UploadLogo($request['image']);
            $executor->update(['image' => $image_name]);
        }

        if (!empty($request['files'])) {
            $this->fileLogic->UploadFilesAccount($request['files'], $id);
        }

        if (!empty($request['category_ids'])) {
            $executor->categories()
                ->sync(explode(',', $request['category_ids']));
        }

        if (!empty($request['payment_type_ids'])) {
            $executor->payment_types()
                ->sync(explode(',', $request['payment_type_ids']));
        }

        if (!empty($request['additional_service_ids'])) {
            $executor->additional_services()
                ->sync(explode(',', $request['additional_service_ids']));
        }

    }

    public function update_settings($request, $id)
    {
        $executor = $this->executor->findOrFail($id);
        $executor->get_email = $request['get_email'] ?? 0;
        $executor->show_profile = $request['show_profile'] ?? 0;
        $executor->save();
    }

    public function change_verified($executor, $request)
    {
        if($request['verified'] != $executor->verified)
        {
            if($executor->verified != 1){
                get_user($executor->id)
                    ->notify(new ExecutorIsVerifiedNotification($executor));
            }
        }
    }

}
