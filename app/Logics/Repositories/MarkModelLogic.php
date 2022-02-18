<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\MarkLogicInterface;
use App\Models\Mark;
use App\Models\MarkModel;

class MarkModelLogic implements MarkLogicInterface
{

    protected $mark_model;
    protected $mark;

    public function __construct(Mark $mark, MarkModel $mark_model)
    {

        $this->mark_model = $mark_model;
        $this->mark = $mark;
    }

    public function all()
    {
        return $this->mark_model->paginate(20);
    }

    public function store($request)
    {
        $this->mark_model->create($request);
    }

    public function create()
    {
        return $this->mark->all();
    }

    public function edit($id)
    {
        $mark_model = $this->mark_model->with('mark')->findOrFail($id);
        $marks = $this->mark->all();

        return ['mark_model' => $mark_model, 'marks' => $marks];
    }

    public function update($request, $id)
    {
        $this->mark_model->findOrFail($id)->update($request);
    }

    public function get_list($id)
    {
        return $this->mark_model->where('mark_id', $id)->get();
    }

}
