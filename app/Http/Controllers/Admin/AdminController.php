<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreAdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminUserMail;
use Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    /**
     * Display a listing of the admin.
     *
     * @return view
     */
    public function index()
    {
        if(Gate::allows('isAdmin')){
            $admins = Admin::orderBy('id','DESC')->get();
            return view('admins.view')->with('admins',$admins);
        }else{
            abort(403);
        }
    }
 
    /**
     * Show the form for creating a new admin.
     *
     * @return view
     */
    public function create()
    {
        if(Gate::allows('isAdmin')){
            return view('admins.create');
        }else{
            abort(403);
        }
    }

    /**
     * Store a newly created admin in database.
     *
     * @param  StoreAdminRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function store(StoreAdminRequest $request)
    {  
        if(Gate::allows('isAdmin')){
            $data = $request->userData();
            $user = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => \Hash::make($data['password']),
                'status' => $data['status']
            ]);        
                            
            if($user){
                Mail::to($user->email)->send(new AdminUserMail($request->get('email'), $data['password']));
                $notification = array(
                    'message' => 'Success! User has been created.', 
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.create')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Error ! Something went wrong', 
                    'alert-type' => 'error'
                );
                return redirect()->route('admin.create')->with($notification)->withInput();
            }
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param  User  $user
     * @return view
     */
    public function edit(Admin $admin)
    {
        if(Gate::allows('isAdmin')){
            return view('admins.edit')->with(['admin'=>$admin]);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Redirect
     */
    public function update(Request $request, $id)
    {
        if(Gate::allows('isAdmin')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:160|string',
                'email' => ['required','email','unique:admins,email,'.$id]
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.admins.edit', $id)
                            ->withErrors($validator)
                            ->withInput();
            }

            Admin::whereId($id)->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'role' => $request->get('role'),
                'status' => $request->get('status')
            ]);

            $notification = array(
                'message' => 'Success! User updated.', 
                'alert-type' => 'success'
            );
            return redirect()->route('admin.index')->with($notification);
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified admin from database.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if(Gate::allows('isAdmin')){
            $admin->delete();
            $data = array(
                'status' => 200,
                'message' => 'Success! User has been deleted.'
            );
            return response()->json($data, 200);
        }else{
            abort(403);
        }
    }
}
