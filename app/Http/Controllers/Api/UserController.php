<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreEditCustomerRequest;
use App\Http\Requests\Api\PasswordResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\FrontendOldUserMail;
use Auth;

class UserController extends Controller
{
    protected function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Edit User
     */
    public function editUser(StoreEditCustomerRequest $request, $id)
    {
        $data = $request->validated();
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $str = substr(str_shuffle($str_result), 0, 10);
        try{
            $result = User::whereId($id)->update($request->all());
            $user = User::whereId($id)->first();
            $email = !$user->email ? $request->email : $user->email;
            if (!$user->password) {
                $data['password'] = \Hash::make($str);
                User::whereId($id)->update($data);
                Mail::to($email)->cc(env('MAIL_FROM_ADDRESS',"hartmanb007@gmail.com"))->send(new FrontendOldUserMail($user->mrt_id, $str));
                Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
                return response()->json([
                    'message' => 'Success! Mail has been sent.',
                    'status' =>  true,
                ], 200);
            } else {
                return response()->json([
                    'status' =>  true,
                    'data' =>  $user,
                ], 200);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'message' =>  "Error! Something went wrong.".$ex->getMessage(),
            ], 422);
        }
    }

    public function passwordReset(PasswordResetRequest $request)
    {
        try{
            User::whereMrtId($request->mrtId)->whereEmail($request->email)->firstOrFail();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $str = substr(str_shuffle($str_result), 0, 10);
            $data['password'] = \Hash::make($str);
            User::whereMrtId($request->mrtId)->whereEmail($request->email)->update($data);
            Mail::to($request->email)->cc(env('MAIL_FROM_ADDRESS',"hartmanb007@gmail.com"))->send(new FrontendOldUserMail($request->mrtId, $str));
            return response()->json([
                'message' => 'Success! Password is reset.',
                'status' =>  true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 8,
                'message' =>  "Account ID and email do not match",
            ]);
        }

    }

}
