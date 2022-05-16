<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChangePasswordRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class ChangePasswordController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return view
     */
    public function index()
    {
        return view('settings.change_password');
    }

    /**
     * Update the password.
     *
     * @return \Illuminate\Http\Redirect
     */
    public function updatePassword(StoreChangePasswordRequest $request)
    {
        Admin::find(Auth::user()->id)->update([
            'password' => \Hash::make($request->get('cpass'))
        ]);

        $notification = array(
            'message' => 'Success! Password has been updated.', 
            'alert-type' => 'success'
        );
        return redirect()->route('change-password')->with($notification);
    }
}
