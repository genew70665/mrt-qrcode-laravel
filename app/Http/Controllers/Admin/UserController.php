<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\StoreUsersRequest;
use Excel;
use App\Import\UsersImport;

class UserController extends Controller
{
    /**
     * method used to display the users list
     */
    public function index(){
        $users = User::orderBy('id','DESC')->get();
        return view('users.view', compact('users'));
    }


    /**
     * Store a CSV Data in database.
     *
     * @param  StoreUsersRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function import(StoreUsersRequest $request)
    {
        try{
            //get file from upload
            $path = request()->file('file');

            //turn into array
            $excelArray = Excel::import(new UsersImport, $path);

            $notification = array(
                'message' => 'Success! records has been Imported successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('users.index')->with($notification);
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $notification = [];
            foreach($e->failures() as $error){
                foreach($error->errors() as $err){
                    $notification = array(
                        'message' => 'Error ! '.$err,
                        'alert-type' => 'error'
                    );
                }
            }
            return redirect()->route('users.index')->with($notification);
        }
    }


    /**
     * Block a user.
     *
     * @param  StoreUsersRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=> "User status is change"]);
    }
}
