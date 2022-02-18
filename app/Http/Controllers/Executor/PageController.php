<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function help()
    {
        return view('site.account.executor.help');
    }

    public function settings()
    {
        $executor = Auth::user();

        return view('site.account.executor.settings', compact('executor'));
    }

}
