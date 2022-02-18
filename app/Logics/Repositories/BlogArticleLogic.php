<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\BlogArticleLogicInterface;
use App\Models\BlogArticle;
use App\Models\BlogCategory;

class BlogArticleLogic implements BlogArticleLogicInterface
{
    protected $article;
    protected $fileLogic;

    public function __construct(BlogArticle $article, FileLogic $fileLogic)
    {
        $this->article = $article;
        $this->fileLogic = $fileLogic;
    }

    public function index(){

        return $this->article->all();
    }

    public function create(){

        return BlogCategory::pluck('name', 'id')
            ->prepend(trans('form.select'), '');
    }

    public function store($request)
    {
        $this->article->name = $request['name'];
        $this->article->description = $request['description'];
        $this->article->blog_category_id = $request['blog_category_id'];
        if ($request['image']) {
            $image_name = $this->fileLogic->UploadBlogArticleImage($request['image']);
            $this->article->image = $image_name;
        }
        $this->article->save();
    }

    public function edit($id){

        $article = $this->article->findOrFail( $id );

        $categories = BlogCategory::pluck('name', 'id')
            ->prepend(trans('form.select'), '');

        return ['article' => $article, 'categories' => $categories];

    }

    public function update($request, $id){

        $article = $this->article->findOrFail($id);
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->blog_category_id = $request['blog_category_id'];
        if (!empty($request['image'])) {
            $image_name = $this->fileLogic->UploadBlogArticleImage($request['image']);
            $article->image = $image_name;
        }
        $article->save();
    }

}
