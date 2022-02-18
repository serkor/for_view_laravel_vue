<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategories\StoreBlogCategoryRequest;
use App\Http\Requests\BlogCategories\UpdateBlogCategoryRequest;
use App\Logics\Repositories\BlogCategoryLogic;

class BlogCategoryController extends Controller
{

    protected $categoryLogic;

    public function __construct(BlogCategoryLogic $categoryLogic)
    {
        $this->categoryLogic = $categoryLogic;
    }

    public function index()
    {
        $categories = $this->categoryLogic->index();

        return view( 'front.blog_categories.index', compact( 'categories') );
    }

    public function create()
    {
        return view( 'front.blog_categories.create' );
    }

    public function store(StoreBlogCategoryRequest $request)
    {
        $this->categoryLogic->store($request->validated());

        return redirect()->route('admin_blog_categories')
            ->with('status', trans('blog_category.success'));
    }

    public function edit($id)
    {
        $category = $this->categoryLogic->edit($id);

        return view( 'front.blog_categories.edit', compact('category') );
    }

    public function update(UpdateBlogCategoryRequest $request, $id)
    {
        $this->categoryLogic->update($request->validated(), $id);

        return redirect()->route('admin_blog_categories')
            ->with('status', trans('blog_category.update'));
    }

}
