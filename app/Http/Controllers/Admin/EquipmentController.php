<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\KitTrack;
use App\Models\User;
use App\Http\Requests\Admin\StoreEquipmentRequest;
use Excel;
use DataTables;
use App\Import\CSVImport;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    /**
     * Display a form to import partners CSV.
     *
     * @return $equipments;
     */
    public function equipmentList()
    {
        $equipments = DB::table('equipments')->orderBy('id');
        return DataTables::queryBuilder($equipments)->toJson();
    }

    /**
     * Display a form to import partners CSV.
     *
     * @return view
     */
    public function index()
    {
        $equipments = Equipment::skip(0)->take(100)->get();
        return view("equipments.view", compact('equipments'));
    }

    public function showEquipdemo()
    {
        return view('equipments.showequipdemo');
    }

    /**
     *
     *
     */
    public function show($id)
    {
        $equipment = Equipment::whereId($id)->first();
        return view("equipments.show", compact('equipment'));
    }

    /**
     * Store a CSV Data in database.
     *
     * @param  StoreEquipmentRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function import(StoreEquipmentRequest $request)
    {
        try{
            $equipments = Equipment::get()->pluck("id")->toArray();
            foreach($equipments as $equipment)
            {
                if(KitTrack::whereEquipmentId($equipment)->doesntExist()){
                    Equipment::whereId($equipment)->delete();
                }
            }
            //get file from upload
            $path = request()->file('file');

            //turn into array
            $excelArray = Excel::import(new CSVImport, $path);
            $notification = array(
                'message' => 'Success! records has been Imported successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('equipment.index')->with($notification);
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
            return redirect()->route('equipment.index')->with($notification);
        }
    }

    /**
     *
     *
     */
    public function selectEquipment(Request $request)
    {
        $id = explode(",",$request->table_id);
        $equipments = Equipment::whereIn('id', $id)->get();
        $mrtId =  substr($equipments[0]['point_id'], 0, -4);
        $user = User::where('mrt_id', $mrtId)->first();
        $user ? $company = $user['company'] : $company = '';
        return view('equipments.print', compact('equipments','company'));
    }
}
