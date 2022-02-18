<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferTemplates\OfferTemplatesStoreRequest;
use App\Logics\Repositories\OfferTemplateLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class OfferTemplateController extends Controller
{

    protected $offerTemplateLogic;

    public function __construct(OfferTemplateLogic $offerTemplateLogic)
    {
        $this->offerTemplateLogic = $offerTemplateLogic;
    }

    public function index()
    {
        $executor = Auth::user();

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/offer_template.php')));

        return view('site.account.executor.offer_template', compact('executor', 'lang'));
    }


    public function list(Request $request)
    {
        $result = $this->offerTemplateLogic->list($request->all());

        return response()->json([
            'all_count' => $result['all_count'],
            'offer_templates' => $result['offer_templates']
        ]);
    }

    public function store(OfferTemplatesStoreRequest $request)
    {
        $result = $this->offerTemplateLogic->store($request->validated());

        return response()->json($result, 200);
    }

    public function destroy(Request $request)
    {
        $result = $this->offerTemplateLogic->delete($request->all());

        return response()->json($result, 200);
    }

}
