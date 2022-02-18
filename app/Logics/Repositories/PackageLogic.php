<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\PackageLogicInterface;
use App\Models\Package;
use App\Services\Fondy;

class PackageLogic implements PackageLogicInterface
{
    protected $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    public function all(){

        return $this->package->all();
    }

    public function index()
    {
        $base = $this->package->findOrFail(1);

        $pro = $this->package->findOrFail(2);

        return ['base' => $base, 'pro' => $pro];
    }

    public function buy($id, $executor_id)
    {
        Fondy::buy($id, $executor_id);
    }

    public function edit($id)
    {
        return $this->package->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->package->findOrFail($id)->update($request);
    }

}
