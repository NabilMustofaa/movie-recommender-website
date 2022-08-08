@extends('layout.main2')
@section('content')
<style>
    nav{
        background-color: #111111 !important;
    }
    body{
        height: 100vh !important;
        overflow-y: hidden;
    }
    
</style>
<div class="container flex w-full h-full">
    <div class=" w-3/12 flex flex-col h-full px-24 bg-[#2e2e2e]">
        <h1 class=" text-3xl font-bold text-white my-4"> Setting </h1>
        <hr>
        <div class="flex flex-col mt-4">
            <a class="text-white" href="">Account</a>
            <a class="text-white" href="">Transaction</a>
            <a class="text-white" href="">Movie List</a>

        </div>
        
    </div>
    <div class=" px-40 py-10 w-9/12 h-full">
        <h1 class="text-white text-lg font-bold "> Your Netflix Account</h1>
        <hr>
        <p>This is details of your account</p>
        <div class="flex my-4">
            <h2 class="font-bold"> Netflix Account</h2>
            <div class="pl-24">
                <div class="flex">
                    <img class="" src="{{ asset('img/foto.jpg') }}" alt="" width="64px">
                    <div class="mx-8 my-2 justify-center items-center" >
                        <p>Name : {{ auth()->user()->name }}</p>
                        <p>Email : {{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-2 text-blue-800">
                    <a href="">Change Name</a>
                    <a href="">Change Email</a>
                    <a href="">Change Photos</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-4 flex">
            <h2 class="font-bold"> Account Binded To</h2>
            <div class="pl-16 flex flex-col">  
                <div> Facebook : <a class="text-blue-800" href="">Binded</a> </div>
                <div> Google   : <a class="text-blue-800" href="">Binded</a> </div>
            </div>    
        </div>
        

    </div>
</div>

@endsection