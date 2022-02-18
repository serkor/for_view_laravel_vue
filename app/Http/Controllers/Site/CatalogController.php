<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\CatalogLogic;
use App\Logics\Repositories\CustomerBidLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    protected $catalogLogic;
    protected $bidLogic;

    public function __construct(CatalogLogic $catalogLogic, CustomerBidLogic $bidLogic)
    {
        $this->catalogLogic = $catalogLogic;
        $this->bidLogic = $bidLogic;
    }

    public function index()
    {
        $user = Auth::user();
        $result = $this->bidLogic->index($user);
        $cars = $result['cars'];
        $cities = $result['cities'];
        $categories = $result['categories'];
        $marks = $result['marks'];
        $mark_models = $result['mark_models'];
        $transmissions = $result['transmissions'];
        $years = $result['years'];

        $lang_bid = collect(@include(resource_path('lang/' . App::getLocale() . '/bid.php')));
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/page.php')));

        return view('site.catalog.index', compact('lang', 'user', 'lang_bid',
                'cars', 'cities', 'categories', 'marks', 'mark_models', 'transmissions', 'years'));
    }

    public function get_executors(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['data']['filters']['name'] ?? '',
            'city_id' => $request['data']['filters']['city_id'] ?? null,
            'category_id' => $request['data']['filters']['category_id'] ?? null,
        ]);

        $sort = $request['data']['sorts']['sort'];

        $result = $this->catalogLogic->list($filter, $sort);

        return response()->json(['all_count' => $result['all_count'], 'executors' => $result['executors']]);
    }

}
