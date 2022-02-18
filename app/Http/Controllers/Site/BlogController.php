<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;

class BlogController extends Controller
{

    public function blog_categories()
    {
        $categories = BlogCategory::paginate(10);

        return view('site.blog.categories', compact('categories'));
    }

    public function blog_category($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blog_categories = BlogCategory::all();
        $articles = BlogArticle::where('blog_category_id', $id)->paginate(10);

        return view('site.blog.category', compact('category', 'articles', 'blog_categories'));
    }

    public function blog_article($id)
    {
        $article = BlogArticle::findOrFail($id);
        $blog_categories = BlogCategory::all();

        return view('site.blog.article', compact('article', 'blog_categories'));
    }

}
