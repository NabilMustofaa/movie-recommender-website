<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use App\Models\User;
use Facade\Ignition\DumpRecorder\Dump;
use Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieResources extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toprated = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key='.env('TMDB_TOKEN'))->json()['results'];

        if(auth()->check()){
            $favorites = favorite::where('user_id',auth()->user()->id)
            ->orderBy('liked', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
            $similar=$this->collaborative();
            $recommended=favorite::where('user_id',$similar)->where('liked',1)->get();
            $movie_recommend=[];
            $movie_liked=[];
            foreach ($toprated as $item) {
                if(in_array($item['id'],$recommended->pluck('movie_id')->toArray()) and !in_array($item['id'],$favorites->pluck('movie_id')->toArray())){
                    array_push($movie_recommend,$item);
                }
                if(in_array($item['id'],$favorites->where('liked',1)->pluck('movie_id')->toArray())){
                    array_push($movie_liked,$item);
                }
            }
            $movie_recommend_genre=$this->genresimilarity($toprated);
        }
        else{
            $favorites = [];
            $movie_recommend=[];
            $movie_recommend_genre=[];
            $movie_liked=[];
        }

        return view('home',[
            'toprated' => $toprated,
            'favorites' => $favorites,
            'recommended' => $movie_recommend,
            'recommended_genre' => $movie_recommend_genre,
            'liked'=>$movie_liked
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail=Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.env('TMDB_TOKEN'))->json();
        dump($detail);
        return view('detail',[
            'detail' => $detail
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function similarity($user1,$user2){
        $favorites1 = favorite::where('user_id',$user1)->get();
        $favorites2 = favorite::where('user_id',$user2)->get();

        $total=0;
        for($i=0;$i<count($favorites1);$i++){
            for($j=0;$j<count($favorites2);$j++){
                if($favorites1[$i]->movie_id == $favorites2[$j]->movie_id){
                    $total=(($favorites1[$i]->liked - $favorites2[$j]->liked)**2)+$total;
                }
            }
        }
        return 1-1/(1+$total);
    }
    private function collaborative(){
        $user=User::all();
        $similarity=array();
        for($i=0;$i<count($user);$i++){
            if($i!=(auth()->user()->id)){
                $similarity[$i]=$this->similarity($user[(auth()->user()->id-1)]->id,$user[$i]->id);
            }
        }
        $mostsimilar= array_search(max($similarity), $similarity);
        return $mostsimilar+1;
    }
    private function genresimilarity($movielist){
        $favorites = favorite::where('user_id',auth()->user()->id)
        ->orderBy('liked', 'DESC')
        ->orderBy('created_at', 'DESC')->get();
        $genres=[];
        foreach ($movielist as $movie) {
            if($movie['id']==$favorites->first()['movie_id']){
                $genres=$movie['genre_ids'];
                break;
            }
        }
        $count=0;
        foreach ($movielist as $movie) {
            $similarity=0;
            foreach ($genres as $genre) {
                if(in_array($genre,$movie['genre_ids'])){
                    $similarity++;
                }
            }
            $movie['similarity']=$similarity;
            $movielist[$count]=$movie;
            $count++;
        }
        $count=0;

        foreach($movielist as $item){
            if (in_array($item['id'],$favorites->pluck('movie_id')->toArray())){
                unset($movielist[$count]);
            }
            if ($item['similarity']==0){
                unset($movielist[$count]);
            }
            $count++;
        }
        $movielist=collect($movielist)->sortByDesc('similarity')->values()->all();
        return($movielist);
    }
}
