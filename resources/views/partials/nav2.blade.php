<!--Nav-->
<nav id="header" class="w-full z-30 top-0 py-5">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

        <!-- Logo -->
        <div class="flex">
            <div class="flex-shrink-0 flex items-center my-auto">
                <a href="{{ url('/') }}" class="flex-shrink-0 text-xl font-semibold">
                    <img src="{{ asset('img/Logo.png') }}" alt="{{ config('app.name') }}" class="h-8">
                </a>
            </div>
            {{-- <div class="text-white text-xl font-bold ml-7 ">
                <a href="">Home</a>
            </div> --}}
            {{-- <div class="text-white text-xl ml-7">
                <a href="">Movies</a>
            </div>
            <div class="text-white text-xl ml-7">
                <a href="">TV Shows</a>
            </div>
            <div class="text-white text-xl ml-7">
                <a href="">Most Popular</a>
            </div> --}}
        </div>
        
        <div class="flex items-center">
            {{-- <div>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </a>
               
            </div> --}}
            @auth
            <div class="text-white text-xl ml-7 ">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown-favorite" type="button" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">My List</span>
                </button>
                <div id="dropdown-favorite" class="hidden z-10 ml-20 rounded shadow border-2 border-gray-400 bg-[#141414]">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                      <li>
                        @for ($i=0;$i<count($liked);$i++)
                        <a href="/detail/{{ $liked[$i]['id'] }}" class="flex py-2 px-4 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-white " type="submit">
                            <img class="rounded" src="https://image.tmdb.org/t/p/w500{{ $liked[$i]["poster_path"] }}" width="50px" height="50px">  
                            <p class="text-white font-bold ml-2">{{ $liked[$i]['title'] }}</p>
                        </a>   
                        <hr> 
                        @endfor
                        
                      </li>
                    </ul>
                </div>
            </div>
            <div id="dropdown" class="hidden z-10 w-44 rounded shadow border-2 border-gray-400 bg-[#141414]">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                      <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <button href="#" class="block py-2 px-4 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-white" type="submit">Sign out</button>
                        </form>
                      </li>
                    </ul>
                </div>
            <div class="text-white text-xl ml-7 ">
                <a href="" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                </a>
            </div>
            <div class="text-white text-xl ml-7 ">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex items-center" type="button">
                {{-- <a class="flex items-center" onclick="dropdown()"> --}}
                    <img class="rounded-full border-2 border-white" src="{{ asset('img/foto.jpg') }}" alt="" width="32px">
                    <div class="ml-2">{{ auth()->user()->name }}</div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                {{-- </a> --}}
                </button>
                <div id="dropdown" class="hidden z-10 w-44 rounded shadow border-2 border-gray-400 bg-[#141414]">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                      <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <button href="#" class="block py-2 px-4 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-white" type="submit">Sign out</button>
                        </form>
                      </li>
                    </ul>
                </div>
            </div> 
            @else
            <div class="text-white text-xl ml-7 ">
                <a href="/login">Login</a>
            </div>       
        </div>    
       
        @endauth
        
        
</nav>