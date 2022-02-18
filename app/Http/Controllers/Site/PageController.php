<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\Mark;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{

    public function home()
    {
        $reviews = Review::with('customer')->with('executor')->get();
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/home.php')));

        return view('site.page.home', compact('reviews', 'lang'));
    }

    public function contacts()
    {
        return view('site.page.contacts');
    }

    public function about()
    {
        return view('site.page.about');
    }

    public function term()
    {
        return view('site.page.term');
    }

    public function public_offer()
    {
        return view('site.page.public_offer');
    }

    public function privacy_policy()
    {
        return view('site.page.privacy_policy');
    }

    public function vacancies()
    {
        return view('site.page.vacancies');
    }

    public function advertising()
    {
        return view('site.page.advertising');
    }

    public function partners()
    {
        return view('site.page.partners');
    }

    public function for_executors()
    {
        return view('site.page.for_executors');
    }

    public function for_customers()
    {
        return view('site.page.for_customers');
    }

    public function car_brands()
    {
        $marks = Mark::all();

        return view('site.page.car_brands', compact('marks'));
    }

    public function customer_service()
    {
        return view('site.page.customer_service');
    }

    public function investors()
    {
        return view('site.page.investors');
    }

}
