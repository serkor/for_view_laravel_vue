<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\MarkLogicInterface;
use App\Models\Mark;

class MarkLogic implements MarkLogicInterface
{

    protected $mark;

    public function __construct(Mark $mark){

        $this->mark = $mark;
    }

    public function all()
    {
        return $this->mark->paginate(20);
    }

    public function store($request)
    {
        $this->mark->create($request);
    }

    public function edit($id)
    {
      return $this->mark->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->mark->findOrFail($id)->update($request);
    }

}
