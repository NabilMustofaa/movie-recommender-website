@extends('layout.main2')
@section('content')
<section class="py-8 h-full w-full">
    <div class="container flex justify-center mx-auto">
        <div class="w-2/6">
            <img class="hover:grow py-5" src="https://image.tmdb.org/t/p/original{{ $detail["poster_path"] }}">
        </div>
        
        <div class="w-4/5 md:w-1/2 px-3 md:px-0 mt-5 ml-20 flex flex-col">
            <div class="flex-grow py-12">
                <div class="flex justify-between">
                    <h3 class="text-white font-bold text-5xl">{{ $detail["title"] }}</h3>
                    <div class="flex items-center">
                        <h3 class="text-white font-bold text-4xl mr-2">{{ $detail["vote_average"] }}</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="gold">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                          </svg>
                    </div>
                </div>
                <p class="text-gray-400 text-lg">
                    <span>{{ $detail["release_date"] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $detail["runtime"] }} Minute</span>
                    @if ($detail["adult"] == True)
                        <span>Adult</span>
                    @endif
                </p>
                <h4 class="text-white font-bold text-2xl mt-5 border-b-4 border-b-red-600 w-fit text-center">Overview</h4>
                <p class="text-white text-base mt-3">{{ $detail["overview"] }}</p>
                <p class="text-gray-400 text-base mt-3">
                    <span class="mr-40">Genre</span> 
                    @foreach ($detail["genres"] as $item)
                        <span class="">{{ $item["name"] }}, </span>
                    @endforeach
                </p>
                <p class="text-gray-400 text-base">
                    <span class="mr-7">Production Companies</span> 
                    @foreach ($detail["production_companies"] as $item)
                        <span class="">{{ $item["name"] }}, </span>
                    @endforeach
                </p>
                <div class="flex items-center">
                    <form action="/pay" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="10000">
                        <input type="hidden" name="movie_title" value="{{ $detail["title"] }}">
                        <input type="hidden" name="movie_id" value="{{ $detail["id"] }}">
                        <button class="bg-red-900 hover:bg-red-700 text-white font-bold py-2.5 px-6 text-lg rounded-sm mt-4">Rent Movie</button>
                    </form>
                    {{-- <a id="sectionLink" class="mt-11" href="/detail">
                        <div class=" bg-white ml-3 opacity-30 text-white font-bold rounded-sm w-40" style="height: 3rem"></div>
                        <div class=" text-white text-lg font-semibold -mt-10 ml-10 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                            <span class="ml-2">Favorite</span>
                        </div>
                    </a> --}}
                    @auth
                        @if ($favorite != null)
                            @if ($favorite['liked']==0)
                                <form action="/like/{{ $detail['id'] }}/update" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <input type="hidden" name="movie_id" value="{{ $detail['id'] }}" >
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="/like/{{ $detail['id'] }}/delete" method="POST">
                                    @csrf
                                    @method('delete')    
                                    <button type="submit" name="liked" value="0" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-neutral-900" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="/like/{{ $detail['id'] }}/delete" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" name="liked" value="1" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-neutral-900"  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="/like/{{ $detail['id'] }}/update" method="POST">
                                    @method('PUT')
                                    @csrf    
                                    <input type="hidden" name="movie_id" value="{{ $detail['id'] }}" >
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                                    <button type="submit" name="liked" value="0" class="rounded-full  border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        @else
                        <form action="/like" method="POST">
                            <input type="hidden" name="movie_id" value="{{ $detail['id'] }}" >
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                            @csrf
                            <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                            </button>
                            <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                </svg>
                            </button>
                        </form>
                        @endif
                    @else
                        <form action="/like" method="POST">
                            <input type="hidden" name="movie_id" value="{{ $detail['id'] }}" >
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                            @csrf
                            <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                            </button>
                            <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                </svg>
                            </button>
                        </form>
                    @endauth
                    
                    
                    
                </div>
                    

                <div class="">
                <h3 class="text-2xl mt-5">Related Movies</h3>
                    <div class="swiper2">
                        <div class="flex">
                            @for ($i=1;$i<5;$i++)
                            <div class="mr-2">
                                <a href="/detail/{{ $similar[$i]['id'] }}" class="thumbTiles">
                                    <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $similar[$i]["poster_path"] }}" width="200px">
                                </a>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>   
            </div>
            
        </div>    
    </div>
</section>    
@endsection