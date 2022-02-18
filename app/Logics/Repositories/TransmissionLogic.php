<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\TransmissionLogicInterface;
use App\Models\Transmission;


class TransmissionLogic implements TransmissionLogicInterface
{
    protected $transmission;

    public function __construct(Transmission $transmission){

        $this->transmission = $transmission;
    }

    public function all()
    {
        return $this->transmission->paginate(20);
    }

    public function store($request)
    {
        $this->transmission->create($request);
    }

    public function edit($id)
    {
      return $this->transmission->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->transmission->findOrFail($id)->update($request);
    }

}
