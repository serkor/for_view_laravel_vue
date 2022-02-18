<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogArticles\StoreBlogArticleRequest;
use App\Http\Requests\BlogArticles\UpdateBlogArticleRequest;
use App\Logics\Repositories\BlogArticleLogic;

class BlogArticleController extends Controller
{
    protected $articleLogic;

    public function __construct(BlogArticleLogic $articleLogic)
    {
        $this->articleLogic = $articleLogic;
    }

    public function index()
    {
        $articles = $this->articleLogic->index();

        return view( 'front.blog_articles.index', compact( 'articles') );
    }

    public function create()
    {
        $categories = $this->articleLogic->create();

        return view( 'front.blog_articles.create', compact('categories') );
    }

    public function store(StoreBlogArticleRequest $request)
    {
        $this->articleLogic->store($request->validated());

        return redirect()->route('admin_blog_articles')
            ->with('status', trans('blog_article.success'));
    }

    public function edit($id)
    {
        $result = $this->articleLogic->edit($id);

        $article = $result['article'];
        $categories = $result['categories'];

        return view( 'front.blog_articles.edit', compact('article', 'categories') );
    }

    public function update(UpdateBlogArticleRequest $request, $id)
    {
        $this->articleLogic->update($request->validated(), $id);

        return redirect()->route('admin_blog_articles')
            ->with('status', trans('blog_article.update'));
    }
}
