<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Starter Template - Nordic Shop: Tailwind Toolbox</title>
    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
	
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

    <style>
        body{
            background-color: #141414;
        }
        html{
            overflow-x: hidden;
        }
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }
                
        #menu-toggle:checked + #menu {
            display: block;
        }
        
        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }
        
        .hover\:grow:hover {
            transform: scale(1.02);
        }
        
        .thumbTiles{
            padding: 0;
        }
    </style>

</head>

<body class=" text-white work-sans leading-normal text-base tracking-normal w-100">

    @include('partials.nav2')

    @yield('content')
    

    {{-- <footer class="container mx-auto py-8 border-t border-gray-400">
        <div class="container flex px-3 py-8 ">
            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full lg:w-1/2 ">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-white">About</h3>
                        <p class="py-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
                        </p>
                    </div>
                </div>
                <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-white">Social</h3>
                        <ul class="list-reset items-center pt-3">
                            <li>
                                <a class="inline-block no-underline hover:text-white hover:underline py-1" href="#">Add social links</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
    direction: 'horizontal',
    slidesPerView: 8,
    spaceBetween: 2,
    loop: true,


  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }});
</script>
<script>
const swiper2 = new Swiper('.swiper2', {
  // Optional parameters
    direction: 'horizontal',
    slidesPerView: 8,
    spaceBetween: 2,


  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }});
</script>

</html>

