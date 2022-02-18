<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\PackageLogic;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    protected $packageLogic;

    public function __construct(PackageLogic $packageLogic)
    {
        $this->packageLogic = $packageLogic;
    }

    public function index()
    {
        $result = $this->packageLogic->index();
        $base = $result['base'];
        $pro = $result['pro'];

        return view('site.account.executor.packages', compact('base', 'pro'));
    }

    public function buy($id)
    {
        $this->packageLogic->buy(intval($id), Auth::id());
    }

}
