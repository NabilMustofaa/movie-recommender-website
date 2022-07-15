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
}
