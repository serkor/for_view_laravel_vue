<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller {

	public function index() {

		$roles = Role::all();

		return view( 'front.roles.index', compact( 'roles' ) );
	}
}
