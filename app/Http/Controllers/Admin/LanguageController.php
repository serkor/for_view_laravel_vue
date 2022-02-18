<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\LanguageLogic;

class LanguageController extends Controller
{
    protected $languageLogic;

    public function __construct(LanguageLogic $languageLogic)
    {
        $this->languageLogic = $languageLogic;
    }

	public function index() {

		$languages = $this->languageLogic->index();

		return view( 'front.languages.index', compact( 'languages' ) );
	}

	public function edit( $id ) {

		$language = $this->languageLogic->edit($id);

		return view( 'front.languages.edit', compact( 'language' ) );
	}

	public function update($id)
    {
        $this->languageLogic->update($id);

		return redirect()
			->route( 'languages.index' )
			->with( 'status', trans( 'info.success' ) );
	}
}
