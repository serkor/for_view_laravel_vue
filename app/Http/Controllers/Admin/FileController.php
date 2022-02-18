<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Files\DestroyFileRequest;
use App\Logics\Repositories\FileLogic;
use App\Http\Controllers\Controller;


class FileController extends Controller {

    protected $fileLogic;

    public function __construct(FileLogic $fileLogic)
    {
        $this->fileLogic = $fileLogic;
    }

	public function index()
    {
		$files = $this->fileLogic->index();

		return view( 'front.files.index', compact( 'files' ) );
	}

	public function destroy(DestroyFileRequest $request)
    {
        $this->fileLogic->destroy($request->validated());

		return back()->with('status',trans('info.destroy'));
	}

}
