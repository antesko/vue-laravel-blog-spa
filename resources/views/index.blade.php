@extends('layouts.master')

@section('content')

    <div id="app">

        @include('layouts.navigation')

        <div class="container">

            <router-view></router-view>

        </div>
    </div>

@endsection