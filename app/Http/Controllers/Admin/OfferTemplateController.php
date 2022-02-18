<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferTemplates\OfferTemplatesStoreRequest;
use App\Logics\Repositories\OfferTemplateLogic;
use App\Models\Executor;
use App\Models\OfferTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OfferTemplateController extends Controller
{

    protected $offerTemplateLogic;

    public function __construct(OfferTemplateLogic $offerTemplateLogic)
    {
        $this->offerTemplateLogic = $offerTemplateLogic;
    }

    public function index()
    {
        $offer_templates = OfferTemplate::all();

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/offer_template.php')));

        return view('front.offer_templates.index', compact('offer_templates', 'lang'));
    }

    public function create()
    {
        $executors = get_list_executor()->pluck('name', 'id');

        return view('front.offer_templates.create', compact('executors'));
    }

    public function store(OfferTemplatesStoreRequest $request)
    {
        $this->offerTemplateLogic->store($request->validated());

        return redirect()->route('offer-templates.index');
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'name' => $request['name'] ?? null,
        ]);

        $offer_templates = OfferTemplate::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.offer_templates.index', compact('offer_templates'));
    }

}
