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
        $toprated = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key=3802f54a5b663782ce73009efb42572f')->json()['results'];
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'movie_id' => $this->faker->randomElement($toprated)['id'],
            'liked'=> $this->faker->boolean(),
        ];
    }
}
