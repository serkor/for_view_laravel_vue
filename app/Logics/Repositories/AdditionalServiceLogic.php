<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\AdditionalServiceLogicInterface;
use App\Models\AdditionalService;

class AdditionalServiceLogic implements AdditionalServiceLogicInterface
{

    protected $service;

    public function __construct(AdditionalService $service){

        $this->service = $service;
    }

    public function all()
    {
        return $this->service->paginate(20);
    }

    public function store($request)
    {
        $this->service->create($request);
    }

    public function edit($id)
    {
      return $this->service->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->service->findOrFail($id)->update($request);
    }

}
