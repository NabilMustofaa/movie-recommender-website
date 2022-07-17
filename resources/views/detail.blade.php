@extends('layout.main')


@section('content')
<section class="bg-white py-8 h-full w-full">
    <div class="container flex justify-center mx-auto">
        <div>
            <img class="hover:grow py-5" src="https://image.tmdb.org/t/p/w400{{ $detail["poster_path"] }}">
            <div class="flex justify-between">
                @foreach ($detail["production_companies"] as $company)
                    @if ($company["logo_path"] != Null)
                        <img src="https://image.tmdb.org/t/p/w200{{ $company["logo_path"] }}" alt="{{ $company["name"] }}" class="h-6 hover:grow">
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="w-4/5 md:w-1/2 px-3 md:px-0 mt-5 ml-20 flex flex-col">
            <div class="flex-grow">
                <h3 class="text-gray-900 font-bold text-xl">{{ $detail["title"] }} ({{ $detail["original_title"]}})  </h3>
            <p class="text-gray-600 text-base">
                @foreach ($detail['genres'] as $genre )
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $genre["name"] }}</span>
                @endforeach
            </p>
            <h4 class="text-black font-bold text-l mt-5">{{ $detail["tagline"] }}</h4>
            <p class="text-black text-base mt-2">Overview</p>
            <p class="text-gray-600 text-base">{{ $detail["overview"] }}</p>
            <p class="text-black text-base mt-2">Release Date</p>
            <p class="text-gray-600 text-base">{{ $detail["release_date"] }}</p>
            <p class="text-black text-base mt-2">Rating</p>
            <p class="text-gray-600 text-base">{{ $detail["vote_average"] }}</p>
            <p class="text-black text-base mt-2">Price</p>
            <p class="text-gray-600 text-base">10.000</p>
            </div>
            <div class="">
                <form action="/pay" method="POST">
                    @csrf
                    <input type="hidden" name="price" value="10000">
                    <input type="hidden" name="movie_title" value="{{ $detail["title"] }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Buy</button>
                </form>
            </div>
        </div>    
    </div>
</section>    
@endsection