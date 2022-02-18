<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Logics\Repositories\CategoryLogic;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryLogic;

    public function __construct(CategoryLogic $categoryLogic)
    {
        $this->categoryLogic = $categoryLogic;
    }

    public function index()
    {
        $categories = $this->categoryLogic->index();

        return view( 'front.categories.index', compact( 'categories') );
    }

    public function create()
    {
        $categories = $this->categoryLogic->create();

        return view( 'front.categories.create', compact( 'categories')  );
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryLogic->store($request->validated());

        return redirect()->route('admin_categories')
            ->with('status', trans('category.success'));
    }

    public function edit($id)
    {
        $result = $this->categoryLogic->edit($id);

        $category = $result['category'];
        $categories = $result['categories'];

        return view( 'front.categories.edit', compact('category', 'categories') );
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->categoryLogic->update($request->validated(), $id);

        return redirect()->route('admin_categories')
            ->with('status', trans('category.update'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
        ]);

        $categories = Category::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.categories.index', compact('categories'));
    }

}
