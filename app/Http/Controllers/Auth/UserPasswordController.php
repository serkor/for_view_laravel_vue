<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function update_password(Request $request, $id)
    {
        if (!empty($request['password'])) {
            if ($request['password'] == $request['password_confirmation']) {
                User::findOrFail($id)->updated([
                    'password' => Hash::make($request['password'])
                ]);
                return back()->with('status', trans('auth.success_new_password'));
            } else {
                return back()->withErrors(trans('auth.error_new_password'));
            }
        }
        return back();
    }
}
