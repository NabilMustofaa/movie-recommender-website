@extends('layout.main2')
@section('content')
    <section class="w-screen backdrop-blur" style="background-image: url('https://image.tmdb.org/t/p/original{{ $toprated[0]["backdrop_path"] }}');background-size:cover;height:auto" >
        <div class="pt-64 pb-10 pl-24 pr-4 backdrop-brightness-50 w-screen h-full">   
            <h1 class="text-6xl w-2/5 text-center font-extrabold">{{ $toprated[0]["title"] }} </h1>
            <h3 class="text-white text-lg w-2/5 mt-6 ml-8">{{ $toprated[0]["overview"] }}</h3>
            <button class="mt-2">
                <div class=" bg-white ml-8 opacity-30 text-white font-bold rounded-sm w-56 h-12"></div>
                <div class=" text-white text-lg font-semibold -mt-10 ml-16 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2">Movie Detail</span>
                </div>
            </button>
            <h3 class="text-white text-lg font-bold ml-8 mt-10">Top Rated Movies</h3>
            <div class="ml-8 mr-20 p-0">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($toprated as $movie)
                        <div class="ml-2 swiper-slide">
                            <a href="" class="thumbTiles">
                                <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @auth
    <section class="pl-24">
        <h3 class="text-white text-lg font-bold ml-8 mt-10">People liked too</h3>
            <div class="ml-8 mr-20 p-0">
                <div class="swiper2">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($recommended as $movie)
                        <div class="ml-2 swiper-slide">
                            <a href="" class="thumbTiles">
                                <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <h3 class="text-white text-lg font-bold ml-8 mt-10">Similar Movie Based on Your Recent</h3>
            <div class="ml-8 mr-20 p-0">
                <div class="swiper2">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($recommended_genre as $movie)
                        <div class="ml-2 swiper-slide">
                            <a href="" class="thumbTiles">
                                <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>    
            <h3 class="text-white text-lg font-bold ml-8 mt-10">Movie that you been liked</h3>
            <div class="ml-8 mr-20 p-0">
                <div class="swiper2">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($liked as $movie)
                        <div class="ml-2 swiper-slide">
                            <a href="" class="thumbTiles">
                                <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>    
    </section>

    @endauth
    
@endsection