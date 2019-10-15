<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        {{--@extends('layouts.app')--}}

        {{--@section('content')--}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"
                             style="font-size: 20px; background-color: darkgrey;">{{ __('Enter your donation') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{route('store_path')}}">
                                @csrf

                                <div class="form-group row">
                                    <label for="location"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                    <div class="col-md-6">

                                        <div class="input-group">
                                            <input type="text" name="amount" class="form-control mr-auto"
                                                   aria-label="Amount (to the nearest dollar)"
                                                   style="text-align:right;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">0.0</span>
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone Number"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+256</span>
                                            </div>
                                            <input type="text" name="phone" class="form-control"
                                                   aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="location"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control rounded-0" id="" name="remark"
                                                  rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4 mr-5">
                                        <button type="submit" class="btn btn-dark" value="donate">
                                            {{ __('Donate') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-header font-weight-bold">Donations</div>
                        <div class="card-body">
                            <table>

                                @foreach($donations as $donation)
                                   <tr>
                                       <th></th>
                                    <th></th>
                                    <th></th>
                                   </tr>
                                    @foreach($users as $user)
                                                @if($user->id === $donation->user_id)
                                                    <tr>
                                                <td><span class="font-weight-bold">{{ $user->name}}</span></td> <td></td>
                                                        @endif

                                            @endforeach

                                        <td>{{ $donation['amount'] }}€</td>
                                                    </tr>


                                    @endforeach
                                    <tr>
                                        <td>Total donations = </td>
                                        <td></td>
                                        <td>
                                            {{$data = DB::table("mtn_payments")->sum('amount')}}€</td>
                                    </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
