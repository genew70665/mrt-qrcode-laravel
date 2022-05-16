<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreKitTrackRequest;
use App\Models\Equipment;
use App\Models\KitTrack;
use App\Models\Kit;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendScannedData;
use Auth;

class QRCodeController extends Controller
{
    /**
     * getting the equipment and the sample kit data
     *
     * @param $code
     */
    public function index($code)
    {
        $equipment = Equipment::wherePointId($code)->first();
        return response()->json([
            'status' =>  true,
            'data' =>  $equipment
        ]);
    }

    /**
     * getting the equipment and the sample kit data
     *
     * @param $code
     */
    public function kit($code)
    {
        try {
            $kit = Kit::whereKit($code)->first();
            if(!$kit->status == 0)
            {
                return response()->json([
                    'status' =>  false,
                    'code' => 6,
                    'message' =>  "Your scanned or entered kit number is already used."
                ]);
            } else {
                return response()->json([
                    'status' =>  true,
                    'data' =>  $kit
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' =>  false,
                'code' => 5,
                'message' =>  "Your scanned or entered kit number is incorrect."
            ]);
        }
    }

    /**
     * tracking the kit through the user
     */
    public function store(StoreKitTrackRequest $request)
    {
        if (Auth::user()->id == $request->get('user_id')) {
            $data = $request->get('data');

        Mail::to(env('MAIL_FROM_ADDRESS',"hartmanb007@gmail.com"))->send(new SendScannedData(
                $request->get('user_name'),
                $request->get('user_account_id'),
                $request->get('email'),
                $request->get('company'),
                $request->get('address1'),
                $request->get('address2'),
                $request->get('city'),
                $request->get('zip'),
                $request->get('notes'),
                $data
            ));

            foreach ($request->get('data') as $data) {
                $data['user_id'] = Auth::user()->id;
                Kit::whereId($data['kit_id'])->update([
                    'status' =>  '1'
                ]);
                KitTrack::create($data);
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Success! Thanks for submitted the data to MRT.',
            ]);
        } else {
            return response()->json([
                'status' =>  false,
                'message' =>  "Error! User id is invalid."
            ], 422);
        }
    }
}
