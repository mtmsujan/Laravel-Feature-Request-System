@extends('layouts.admin.app')

@section('content')
    <div class="flex items-center justify-center my-10">
        <div class="md:flex">
            <ul
                class="flex items-center md:flex-col gap-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0 flex-1">
                <li>
                    <a href="#"
                        class="inline-flex items-center px-4 py-3 text-white bg-primary rounded-lg active w-full min-w-24"
                        aria-current="page">
                        <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        UI
                    </a>
                </li>

                {{-- <li>
                    <a
                        class="inline-flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed bg-gray-50 w-full min-w-24 dark:bg-gray-800 dark:text-gray-500">
                        <svg class="w-4 h-4 me-2 text-gray-400 dark:text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                        Others</a>
                </li> --}}
            </ul>

            <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full"
                x-data="{ loading: false }">
                <h3 class="md:min-w-[520px] text-lg font-bold text-gray-900 dark:text-white mb-2">UI Settings</h3>
                <form action="{{ route('settings.update') }}" method="POST" class="my-4" enctype="multipart/form-data"
                    x-on:submit="loading = true">
                    @csrf
                    <div class="grid items-center gap-4 grid-cols-2">

                        <div class="leading-tight">
                            <x-label class="text-black font-bold block mb-0" for="app_name"></x-label>
                            <small>App name to show in the title</small>
                        </div>
                        <x-input class="mb-2" name="app_name" :value="$setting?->app_name" />

                        <div class="leading-tight">
                            <x-label class="text-black font-bold block mb-0" for="app_logo"></x-label>
                            <small>App logo will be visible across the application (e.g header, footer etc)</small>
                        </div>
                        <x-input class="mb-2" type="file" name="logo" id="app_logo" />

                        <div class="leading-tight">
                            <x-label class="text-black font-bold block mb-0" for="favicon"></x-label>
                            <small>Favicon will be visible in the title of the webpage</small>
                        </div>
                        <x-input class="mb-2" type="file" name="favicon" id="favicon" />

                        {{-- <div class="leading-tight">
                            <x-label class="text-black font-bold block mb-0" for="primary_color"></x-label>
                            <small>Choose the primary color of the site</small>
                        </div>
                        <x-color-picker :value="$primary" class="mb-2" name="colors[primary]" id="primary_color" /> --}}

                        @foreach ($colors as $color)
                            <div class="leading-tight">
                                <x-label class="text-black font-bold block mb-0" for="{{ $color->label }}"></x-label>
                                <small>Choose the {{ str($color->label)->headline() }} of the site</small>
                            </div>
                            <x-color-picker :value="$color->value" class="mb-2" name="colors[{{ $color->name }}]"
                                id="{{ $color->label }}" />
                        @endforeach

                        <div class="">
                            <x-button x-bind:class="{ 'pointer-events-none cursor-not-allowed': loading }"
                                x-bind:disabled="loading">
                                <span x-show="!loading">Save</span>
                                <x-loader class="text-white" x-show="loading"></x-loader>

                            </x-button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
