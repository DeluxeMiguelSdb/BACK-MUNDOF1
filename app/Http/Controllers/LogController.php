<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Providers\LogsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log as FacadesLog;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, log $log)
    {
        //
    }

    public function getalllogs(){
        $users = log::with('usuarioLog')->get();

        event(new LogsHistory(
            Auth::user()->id,
            Auth::user()->nick,
            Config::get('constants.pages.page_administrador'),
            Config::get('constants.actions.user_logs'),
        ));

        return $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(log $log)
    {
        //
    }
}
