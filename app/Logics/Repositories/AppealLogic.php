<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\AppealLogicInterface;
use App\Models\Appeal;

class AppealLogic implements AppealLogicInterface
{

    protected $appeal;

    public function __construct(Appeal $appeal){

        $this->appeal = $appeal;
    }

    public function all()
    {
        return $this->appeal->all();
    }

    public function store($request)
    {
        $this->appeal->create($request);
    }

    public function edit($id)
    {
      return $this->appeal->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->appeal->findOrFail($id)->update($request);
    }

}
