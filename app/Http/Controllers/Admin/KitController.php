<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreKitNumberRequest;
use App\Models\Kit;
use App\Models\User;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::with('userData')->get();
        return view('kits.view', compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kit = rand(100000000,99999999);
        $users = User::get();
        return view('kits.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreKitNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitNumberRequest $request)
    {
        $account_id = $request->user;
        $number = $request->number;
        $description = $request->description;
        for($i=0; $i<$number; $i++){
            Kit::create([
                'user' => $account_id,
                'kit' => rand(10000000,99999999),
                'description' => $description
            ]);
        }
        $kits = Kit::whereUser($account_id)->latest()->take($number)->get();
        return view('kits.print', compact('kits'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kit = Kit::whereId($id)->first();
        return view('kits.show', compact('kit'));
    }
}
