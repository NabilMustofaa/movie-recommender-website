<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
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
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        $favorites = favorite::where('user_id',auth()->user()->id)
        ->orderBy('liked', 'ASC')
        ->orderBy('created_at', 'DESC')
        ->get();
        $ids=[];
        $toprated=[];
        $movie_liked=[];
        for ($i=1; $i < 11 ; $i++) { 
            foreach (Http::get('https://api.themoviedb.org/3/movie/popular?api_key='.env('TMDB_TOKEN').'&page='.$i)->json()['results'] as $item){
                array_push($toprated,$item);
                array_push($ids,$item['id']);
            }
        }
        foreach ($favorites as $item){
            if(in_array($item->movie_id,$ids) and $item['liked']==1){
                array_push($movie_liked,$toprated[array_search($item->movie_id,$ids)]);
            }
        } 
        return view('setting',[
            'liked' => $movie_liked
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
