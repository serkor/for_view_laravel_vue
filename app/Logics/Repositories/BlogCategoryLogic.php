<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\BlogCategoryLogicInterface;
use App\Models\BlogCategory;

class BlogCategoryLogic implements BlogCategoryLogicInterface
{
    protected $category;

    public function __construct(BlogCategory $category){

        $this->category = $category;
    }

    public function index()
    {
        return $this->category->all();
    }

    public function create(){}

    public function store($request){

        $this->category->create($request);
    }

    public function edit($id)
    {
        return $this->category->findOrFail( $id );
    }

    public function update($request, $id){

        $this->category->findOrFail($id)->update($request);
    }

}
