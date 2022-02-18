<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\CategoryLogicInterface;
use App\Models\Category;

class CategoryLogic implements CategoryLogicInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->all();
    }

    public function create()
    {
        return $this->category->with('category')->get();
    }

    public function store($request)
    {
        $this->category->create($request);
    }

    public function edit($id)
    {
        $category = $this->category->with('category')->findOrFail($id);
        $categories = $this->category->with('category')->get();

        return ['category' => $category, 'categories' => $categories];
    }

    public function update($request, $id)
    {
        $this->category->findOrFail($id)->update($request);
    }

}
