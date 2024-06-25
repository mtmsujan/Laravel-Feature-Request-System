@extends('layouts.master')

@section('header')
@include('layouts.frontend.header')
@endsection
@section('main')
<main class="h-full overflow-y-auto">
    @yield('content')
</main>
@endsection

@section('footer')

@endsection
