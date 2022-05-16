<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KitTrack;

class KitTrackController extends Controller
{
    /**
     * method used to display the tracking records
     */
    public function index(){
        $kits = KitTrack::with('user', 'kit')->get();
        return view('kit_tracks.view', compact('kits'));
    }
}
