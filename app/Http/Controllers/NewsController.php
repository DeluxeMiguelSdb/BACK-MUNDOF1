<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Providers\LogsHistory;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $noticias = news::with('creadaPor','comentariosNotica')->get();
        //$noticias = news::with('comentariosNotica')->get();

        event(new LogsHistory(
            Auth::user()->id,
            Auth::user()->nick,
            Config::get('constants.pages.page_noticias'),
            Config::get('constants.actions.news'),
        ));

        return $noticias;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
     * Display the specified resource
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = news::with('creadaPor','comentariosNotica')->where('id','=',$id)->firstOrFail();

        event(new LogsHistory(
            Auth::user()->id,
            Auth::user()->nick,
            Config::get('constants.pages.page_noticia'),
            Config::get('constants.actions.new'),
        ));

        return $noticia;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news)
    {
        //
    }
}
