<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\OfferTemplateLogicInterface;
use App\Models\OfferTemplate;


class OfferTemplateLogic implements  OfferTemplateLogicInterface
{
    protected $offerTemplate;

    public function __construct(OfferTemplate $offerTemplate)
    {
        $this->offerTemplate = $offerTemplate;
    }

    public function list($request)
    {
        $offer_templates = $this->offerTemplate
            ->where('executor_id', $request['executor_id'])
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return [
            'all_count' => $offer_templates->total(),
            'offer_templates' => $offer_templates,
        ];
    }

    public function store($request)
    {
       return $this->offerTemplate->create($request);
    }

    public function delete($request)
    {
        return $this->offerTemplate->findOrFail($request['id'])->delete();
    }

}
