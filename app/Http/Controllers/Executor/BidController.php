<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bids\BidUpdateRequest;
use App\Logics\Repositories\BidStatusLogic;
use App\Logics\Repositories\ExecutorBidLogic;
use App\Models\Executor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    protected $bidLogic;
    protected $bidStatusLogic;

    public function __construct(ExecutorBidLogic $bidLogic, BidStatusLogic $bidStatusLogic)
    {
        $this->bidLogic = $bidLogic;
        $this->bidStatusLogic = $bidStatusLogic;
    }

    public function index()
    {
        $executor = Auth::user();
        $result = $this->bidLogic->index($executor);
        $cities = $result['cities'];
        $categories = $result['categories'];
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/bid.php')));

        return view('site.account.executor.bids.index', compact('executor', 'lang', 'cities', 'categories'));
    }

    public function list(Request $request)
    {
        $filter = \Request::input('filter', [
            'city_id' => $request['city_id'] ?? null,
            'category_id' => $request['category_id'] ?? null,
            'desired_date' => $request['desired_date'] ?? null,
            'type' => $request['type'] ?? null,
        ]);

        $result = $this->bidLogic->list($request, $filter);

        return response()->json(['all_count' => $result['all_count'], 'bids' => $result['bids']]);
    }

    public function count(Request $request)
    {
        $result = $this->bidLogic->count($request);

        return response()->json([
            'open_count' => $result['open_count'],
            'expected_count' => $result['expected_count'],
            'selected_count' => $result['selected_count']
        ], 200);
    }

    public function show($id)
    {
        $executor = Executor::findOrFail(Auth::id());
        $result = $this->bidLogic->show($id);
        $bid = $result['bid'];
        $files = $result['files'];
        $offer_templates = $executor->offer_templates;
        $statuses = $this->bidStatusLogic->all();
        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/bid.php')));

        if (is_null($bid->executor_id)) {
            return view('site.account.executor.bids.show',
                compact('bid', 'executor', 'lang', 'statuses', 'files', 'offer_templates'));
        } else {
            if ($bid->executor_id === $executor->id) {
                return view('site.account.executor.bids.show',
                    compact('bid', 'executor', 'lang', 'statuses', 'files', 'offer_templates'));
            } else {
                return redirect()->route('no_access');
            }
        }
    }

}
