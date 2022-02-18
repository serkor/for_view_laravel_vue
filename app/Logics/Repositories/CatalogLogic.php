<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CatalogLogicInterface;
use App\Models\Category;
use App\Models\City;
use App\Models\Executor;

class CatalogLogic implements CatalogLogicInterface
{
    public function list($filter, $sort)
    {
        $result = $this->get_executors($filter, $sort);

        return [
            'executors' => $result['executors'],
            'all_count' => $result['all_count'],
        ];
    }

    public function get_executors($filter, $sort)
    {
        $executors = Executor::with('reviews')
            ->where('type', 2)
            ->where('verified', 1)
            ->where('show_profile', 'on')
            ->filter($filter)
            ->orderBy($sort, 'DESC')
            ->paginate(9);

        return [
            'all_count' => $executors->total(),
            'executors' => $executors,
        ];
    }

    public function get_cities()
    {
        return City::with('city')
            ->where('parent_id', '!=', 0)
            ->get();
    }

    public function get_categories()
    {
        return Category::with('category')
            ->where('parent_id', '!=', 0)
            ->get();
    }

}
