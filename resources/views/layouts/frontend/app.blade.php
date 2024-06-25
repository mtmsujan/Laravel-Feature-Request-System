@extends('layouts.master')

@section('header')
    @include('layouts.frontend.header')

    @push('modals')
        <!-- Top Left Modal -->
        <div id="top-left-modal" data-modal-placement="top-left" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full mx-auto" id="hx-auth-section">
                <!-- Modal content -->
                @auth
                    @include('auth.partials.logout')
                @else
                    @include('auth.partials.login')
                @endauth
            </div>
        </div>
    @endpush
@endsection
@section('main')
    <main class="h-full overflow-y-auto mb-8">
        @yield('content', 'Hello world!')
    </main>
@endsection

@section('alerts')
<div id="alerts" hx-swap-oob="true">
    <x-alert/>
</div>
@endsection
