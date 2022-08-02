@extends('layout.main2')
@section('content')
    <section id="bg-section" class="w-screen backdrop-blur" style="background-image: url('https://image.tmdb.org/t/p/original{{ $toprated[0]["backdrop_path"] }}');background-size:cover;height:auto" >
        <div class="pt-64 pb-10 pl-24 pr-4 bg-gradient-to-r from-black w-screen h-full flex flex-col ">   
            <div class="h-2/5">
                <h1 id="sectionTitle" class="text-5xl ml-8 w-2/5 text-center font-extrabold">{{ $toprated[0]["title"] }} </h1>
                <h3 id="sectionOverview" class="text-white text-lg w-2/5 mt-6 ml-8">{{ $toprated[0]["overview"] }}</h3>
                <a id="sectionLink" class="mt-2" href="/detail/{{ $toprated[0]['id'] }}">
                    <div class=" bg-white ml-8 opacity-30 text-white font-bold rounded-sm w-56 h-12"></div>
                    <div class=" text-white text-lg font-semibold -mt-10 ml-16 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2">Movie Detail</span>
                    </div>
                </a>
            </div>
            <div  class="align-baseline">
                <h3 class="text-white text-lg font-bold ml-8 mt-10">Top Rated Movies</h3>
                <div class="ml-8 mr-20 p-0">
                    <div class="swiper">
                        @php
                            $i = 0;
                        @endphp
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            @foreach ($toprated as $movie)
                            <div class="ml-2 swiper-slide">
                                <a class="thumbTiles" onclick='changeSection("{{ $movie["backdrop_path"] }}","{{ $movie["title"] }}","{{ $movie["overview"] }}","{{ $movie["id"] }}")'>
                                    <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                                </a>
                            </div>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    @if (auth()->check() and $recommended_genre != null)
    <section class="pl-24">
        <h3 class="text-white text-lg font-bold ml-8 mt-10">People liked too</h3>
            <div class="ml-8 mr-20 p-0">
                <div class="swiper2">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach ($recommended as $movie)
                        <div class="ml-2 swiper-slide hover:grow hover:shadow-lg hover:!w-[500px] hover:transition hover:delay-300 hover:duration-300 hover:ease-in-out rounded flex">
                            <img id="detail_{{ $movie['id'] }}" class=" detail flex" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px" onmouseover="openDetail({{ $movie['id'] }})" onmouseout="closeDetail({{ $movie['id'] }})">
                            <div id="detail_{{ $movie['id'] }}" class="detail hidden flex-col w-full bg-[#303030] p-4" onmouseover="openDetail({{ $movie['id'] }})" onmouseout="closeDetail({{ $movie['id'] }})">
                                <p class=" text-2xl text-white mb-4" href="/detail/{{ $movie['id'] }}"> {{ $movie['title'] }}</p>
                                <p class="mb-2">
                                    @foreach ( $movie['genre_ids'] as $genre_id)
                                        @foreach ($genres as $genre)
                                            @if ($genre_id == $genre['id'])
                                                <span class="text-white">{{ $genre['name'] }}, </span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </p>
                                <p class="text-white mb-2">{{ Str::limit($movie['overview'],100) }}</p>
                                
                                <div class="mt-auto flex">
                                    <a id="sectionLink" class="mt-4" href="/detail/{{ $movie['id'] }}">
                                        <div class=" bg-white opacity-30 text-white font-bold rounded-sm w-28 h-12"></div>
                                        <div class=" text-white text-lg font-semibold -mt-10 ml-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="ml-2">Detail</span>
                                        </div>
                                    </a>
                                    @if ($favorites->contains('movie_id', $movie['id']) and $favorites->contains('user_id', auth()->user()->id))
                                        @if($favorites->where('movie_id', $movie['id'])->first()->liked == 1)
                                            <form action="/like/{{ $movie['id'] }}/delete" method="POST">
                                            @csrf
                                            @method('delete')
                                            {{-- <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                                            <button type="submit" name="liked" value="1" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-[#141414]" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                            </button>
                                            </form>     
                                        @else
                                        <form action="/like/{{ $movie['id'] }}/update" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                        </button>
                                        </form>      
                                        @endif
                                        @if ($favorites->where('movie_id', $movie['id'])->first()->liked == 0)
                                        <form action="/like/{{ $movie['id'] }}/delete" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="liked" value="0" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-[#141414]" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                        </button>
                                        </form>
                                        @else
                                        <form action="/like/{{ $movie['id'] }}/update" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                        </button>   
                                        @endif
                                        </form>
                                    @else
                                    <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    </button>
                                    </form>    
                                    <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">   
                                    <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    </button>
                                    </form>        
                                    @endif 
                                </div>
                                
                            </div>
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
                        <div class="ml-2 swiper-slide hover:grow hover:shadow-lg hover:!w-[500px] hover:transition hover:delay-300 hover:duration-300 hover:ease-in-out rounded flex">
                            <img id="detail_{{ $movie['id'] }}" class=" detail flex" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px" onmouseover="openDetail({{ $movie['id'] }})" onmouseout="closeDetail({{ $movie['id'] }})">
                            <div id="detail_{{ $movie['id'] }}" class="detail hidden flex-col w-full bg-[#303030] p-4" onmouseover="openDetail({{ $movie['id'] }})" onmouseout="closeDetail({{ $movie['id'] }})">
                                <p class=" text-2xl text-white mb-4" href="/detail/{{ $movie['id'] }}"> {{ $movie['title'] }}</p>
                                <p class="mb-2">
                                    @foreach ( $movie['genre_ids'] as $genre_id)
                                        @foreach ($genres as $genre)
                                            @if ($genre_id == $genre['id'])
                                                <span class="text-white">{{ $genre['name'] }}, </span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </p>
                                <p class="text-white mb-2">{{ Str::limit($movie['overview'],100) }}</p>
                                
                                <div class="mt-auto flex">
                                    <a id="sectionLink" class="mt-4" href="/detail/{{ $movie['id'] }}">
                                        <div class=" bg-white opacity-30 text-white font-bold rounded-sm w-28 h-12"></div>
                                        <div class=" text-white text-lg font-semibold -mt-10 ml-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="ml-2">Detail</span>
                                        </div>
                                    </a>
                                    @if ($favorites->contains('movie_id', $movie['id']) and $favorites->contains('user_id', auth()->user()->id))
                                        @if($favorites->where('movie_id', $movie['id'])->first()->liked == 1)
                                            <form action="/like/{{ $movie['id'] }}/delete" method="POST">
                                            @csrf
                                            @method('delete')
                                            {{-- <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                                            <button type="submit" name="liked" value="1" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-[#141414]" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                            </button>
                                            </form>     
                                        @else
                                        <form action="/like/{{ $movie['id'] }}/update" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                        </button>
                                        </form>      
                                        @endif
                                        @if ($favorites->where('movie_id', $movie['id'])->first()->liked == 0)
                                        <form action="/like/{{ $movie['id'] }}/delete" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="liked" value="0" class="rounded-full bg-white border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-[#141414]" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                        </button>
                                        </form>
                                        @else
                                        <form action="/like/{{ $movie['id'] }}/update" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                        </button>   
                                        @endif
                                        </form>
                                    @else
                                    <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" name="liked" value="1" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    </button>
                                    </form>    
                                    <form action="/like" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">   
                                    <button type="submit" name="liked" value="0" class="rounded-full border-white border-2 py-2.5 px-2.5 ml-2 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                        </svg>
                                    </button>
                                    </form>        
                                    @endif 
                                </div>
                                
                            </div>
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
                            <a href="/detail/{{ $movie['id'] }}" class="thumbTiles">
                                <img class="hover:grow hover:shadow-lg rounded" src="https://image.tmdb.org/t/p/w500{{ $movie["poster_path"] }}" width="200px">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>    
    </section>
    @endif
  
    <script>
        function changeSection(backdrop,title,overview,id){
            let bgSection = document.getElementById("bg-section");
            bgSection.style.backgroundImage = "url('https://image.tmdb.org/t/p/original" + backdrop + "')";
            let sectionTitle = document.getElementById("sectionTitle");
            sectionTitle.innerHTML = title;
            let sectionOverview = document.getElementById("sectionOverview");
            sectionOverview.innerHTML = overview;
            let sectionLink = document.getElementById("sectionLink");
            sectionLink.href = "/detail/" + id;
        }
        function closeDetails(){
            let details = document.querySelectorAll("div.detail");
            details.forEach( detail => {
                detail.classList.remove("flex");
                detail.classList.add("hidden");    
            });
            
        }
        function openDetail(id){
            closeDetails();
            let detail = document.querySelector("div#detail_" + id);
            detail.classList.remove("hidden");
            detail.classList.add("flex");
            let imgDetail = document.querySelector("img#detail_" + id);
            imgDetail.setAttribute( "onClick", "closeDetail("+id+")" );
        }
        function closeDetail(id){
            let detail = document.querySelector("div#detail_" + id);
            detail.classList.remove("flex");
            detail.classList.add("hidden");    
            let imgDetail = document.querySelector("img#detail_" + id);
            imgDetail.setAttribute( "onClick", "openDetail("+id+")" );
        }

    </script>
@endsection