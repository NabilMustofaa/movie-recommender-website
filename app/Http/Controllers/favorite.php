<?php

namespace App\Http\Controllers;

use App\Models\favorite as ModelsFavorite;
use Illuminate\Http\Request;

class favorite extends Controller
{
    public function favorite(Request $request)
    {
        ModelsFavorite::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'liked' => $request->liked
        ]);
        return redirect()->back()->with('alert', 'Movie Liked');
    }
    public function updatefavorite(Request $request,$id)
    {
        ModelsFavorite::where('user_id', auth()->user()->id)
            ->where('movie_id', $id)
            ->update(['liked' => $request->liked]);
        return redirect()->back()->with('alert', 'Movie Liked');
    }

    public function deletefavorite($id){
        ModelsFavorite::where('user_id', auth()->user()->id)
            ->where('movie_id', $id)
            ->delete();
        return redirect()->back()->with('alert', 'Movie Unliked');
    }
}
