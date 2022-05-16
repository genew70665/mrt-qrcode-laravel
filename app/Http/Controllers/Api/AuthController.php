<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreCustomerRequest;
use App\Http\Requests\Api\StoreExistingCustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\FrontendUserMail;
use Auth;

class AuthController extends Controller
{
    protected function guard()
    {
        return Auth::guard('api');
    }

    /**
     * for new customer
     */
    public function register(StoreCustomerRequest $request)
    {
        $mrtId = rand(pow(10, 7 - 1), pow(10, 7) - 1);
        $data = $request->validated();
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $str = substr(str_shuffle($str_result), 0, 10);

        $data['password'] = \Hash::make($str);
        $data['mrt_id'] = $mrtId;
        try {
            $user = User::create($data);
            Mail::to($user->email)->cc(env('MAIL_FROM_ADDRESS',"hartmanb007@gmail.com"))->send(new FrontendUserMail($mrtId, $str));
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'message' =>  "Something went wrong. ".$ex->getMessage()
            ]);
        }
    }

    /**
     * for existing customer
     */
    public function login(StoreExistingCustomerRequest $request)
    {
        $credentials = [
            'mrt_id' => $request['mrt_id'],
            'password' => $request['password'],
        ];

        try {
            $user = User::whereMrtId($request['mrt_id'])->firstOrFail();

            if($user->status == 0)
                {
                    return response()->json([
                        'status' => false,
                        'code' => 1,
                        'message' =>  "Your account ID is blocked. Contact to Admin.",
                    ], 401);
                }

            $token = $user->createToken('auth_token')->plainTextToken;

            if ($user->password == null) {
                return response()->json([
                'status' => true,
                'message' => 'Generate Password',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user
            ]);
            }
            if ($request['password'] == '' && $user->password != null) {
                if (!Auth::guard('api')->attempt($credentials)) {
                    return response()->json([
                        'status' => false,
                        'code' => 2,
                        'message' => 'Password is exist',
                    ], 401);
                }
            } else {
                if (!Auth::guard('api')->attempt($credentials)) {
                    return response()->json([
                        'status' => false,
                        'code' => 3,
                        'message' => 'Invalid credentials'
                    ], 401);
                }

                $user = User::whereMrtId($request['mrt_id'])->firstOrFail();

                if($user->status == 0)
                {
                    return response()->json([
                        'status' => false,
                        'code' => 1,
                        'message' =>  "Your account ID is blocked. Contact to Admin.",
                    ], 401);
                }

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'data' =>  $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 1,
                'message' =>  "Please enter a valid Account ID.",
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $result = auth()->user()->tokens()->delete();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => "User Logout"
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 401);
        }
    }
}
