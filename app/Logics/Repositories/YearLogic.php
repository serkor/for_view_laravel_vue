<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\YearLogicInterface;
use App\Models\Year;

class YearLogic implements YearLogicInterface
{

    protected $year;

    public function __construct(Year $year){

        $this->year = $year;
    }

    public function all()
    {
        return $this->year->paginate(20);
    }

    public function store($request)
    {
        $this->year->create($request);
    }

    public function edit($id)
    {
      return $this->year->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->year->findOrFail($id)->update($request);
    }

}
