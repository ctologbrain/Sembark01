<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            .btn{
                padding: 5px 10px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
            }
            .btn:hover{
                background-color: #0056b3;
            }
        </style>

        <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
        <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   @if(Auth::user()->role_id ==1)
               <a href="{{url('client')}}" class="btn btn-default">Client </a>  | 
                   <a href="{{url('shorturl')}}" class="btn btn-default">Short Url's</a> |
                   <a href="{{url('AdminList')}}" class="btn btn-default">Admin</a>
                   @if(URL::current()==url('client') || URL::current()==url('InviteClient'))
                   <a href="{{url('InviteClient')}}" class="btn btn-default" style="float:right">Invite</a>
                   @elseif(URL::current()==url('AdminList') || URL::current()==url('AddAdmin'))
                   <a href="{{url('AddAdmin')}}" class="btn btn-default" style="float:right">Invite </a> 
                  @endif
                  @elseif(Auth::user()->role_id ==2)
                   <div class="p-6 text-gray-900">
                   <a href="{{url('ShortUrlAdmin')}}" class="btn btn-default">Short Url's</a> 
                   <a href="{{url('AdminAndMemberList')}}" class="btn btn-default">Admin</a>
                @endif
                </div>
            </div>
        </div>
    </div>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
