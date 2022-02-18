<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\FavoriteLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FavoriteController extends Controller
{
    protected $favoriteLogic;

    public function __construct(FavoriteLogic $favoriteLogic)
    {
        $this->favoriteLogic = $favoriteLogic;
    }

    public function get_list(){

        $result = $this->favoriteLogic->get_list();

        $all_count = $result['all_count'];
        $favorites = $result['favorites'];

        return response()->json(['all_count' => $all_count, 'favorites' => $favorites]);
    }

    public function favorites()
    {
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/favorites.php')));

        return view('site.account.customer.favorites', compact('lang'));
    }

    public function add(Request $request)
    {
        $result = $this->favoriteLogic->add($request->id);

        return response()->json($result, 200);
    }

    public function del(Request $request)
    {
        $result = $this->favoriteLogic->del($request->id);

        return response()->json($result, 200);
    }
}
