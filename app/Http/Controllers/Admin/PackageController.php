<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\PackageLogic;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    protected $packageLogic;

    public function __construct(PackageLogic $packageLogic)
    {
        $this->packageLogic = $packageLogic;
    }

    public function all()
    {
        $packages = $this->packageLogic->all();

        return view('front.packages.index', compact('packages'));
    }

    public function edit($id)
    {
        $package = $this->packageLogic->edit($id);

        return view('front.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $this->packageLogic->update($request->all(), $id);

        return back();
    }

}
