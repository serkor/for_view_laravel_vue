<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\BidLogic;
use App\Logics\Repositories\BidStatusLogic;
use Illuminate\Http\Request;

class BidStatusController extends Controller
{
    protected $bidLogic;
    protected $bidStatusLogic;

    public function __construct(BidLogic $bidLogic, BidStatusLogic $bidStatusLogic)
    {
        $this->bidLogic = $bidLogic;
        $this->bidStatusLogic = $bidStatusLogic;
    }

    public function update(Request $request, $id)
    {
        $this->bidStatusLogic->update($request, $id);

        return back()->with('status', 'Обновлен!');
    }
}
