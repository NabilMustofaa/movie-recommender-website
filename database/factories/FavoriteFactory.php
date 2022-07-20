<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class FavoriteFactory extends Factory
{
    protected $model = \App\Models\Favorite::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $toprated = [];
        for ($i=1; $i < 11 ; $i++) { 
            foreach (Http::get('https://api.themoviedb.org/3/movie/popular?api_key='.env('TMDB_TOKEN').'&page='.$i)->json()['results'] as $item){
                array_push($toprated,$item);
            }
        }
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'movie_id' => $this->faker->randomElement($toprated)['id'],
            'liked'=> $this->faker->boolean(),
        ];
    }
}
