
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
        
        .backdrop-brightness-20{
            background-color: rgba(0, 0, 0, 0.812);
        }
    </style>

</head>

<body class=" text-white work-sans leading-normal text-base tracking-normal w-100" style="background-image: url({{ asset('img/net-bg.jpg') }})">
  <div class="h-full w-full py-40 backdrop-brightness-50">
    
    <div class="text-white w-2/6 py-20 mx-auto backdrop-brightness-20 rounded-md" style=" z-index:99">
      <h2 class="text-5xl font-bold mx-16">Register</h2>
      <form action="/register" method="post">
        @csrf
        <div class="mx-12">
          <div class="flex flex-wrap mt-5">
            <div class="w-full px-3">
              <input type="email" name="email" id="email" class=" bg-gray-600 rounded w-full py-5 px-12 text-gray-200 text-base leading-tight" placeholder="Email">
            </div>
          </div>
          <div class="flex flex-wrap mt-5">
            <div class="w-full px-3">
              <input type="name" name="name" id="name" class=" bg-gray-600 rounded w-full py-5 px-12 text-gray-200 text-base leading-tight" placeholder="name">
            </div>
          </div>
          <div class="flex flex-wrap mt-5">
            <div class="w-full px-3">
              <input type="password" name="password" id="password" class=" bg-gray-600 rounded w-full py-5 px-12 text-gray-200 text-base leading-tight" placeholder="Password">
            </div>
          </div>
          <div class="flex flex-wrap mt-5">
            <div class="w-full px-3">
              <button type="submit" class="shadow bg-red-700 appearance-none rounded w-full py-5 px-12 text-gray-200 text-lg font-bold leading-tight focus:outline-none focus:shadow-outline">Register</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</body>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</html>

