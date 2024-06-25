@extends('layouts.frontend.app')

@push('modals')
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form x-ref="form" action="" method="POST" enctype="multipart/form-data"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                @csrf
                @method('PUT')
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Update Feedback
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4" id="hx-update-target">
                    <div class="flex items-center justify-center h-28">
                        <x-loader />
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center gap-2 justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                </div>
            </form>
        </div>
    </div>
@endpush
@section('content')
    {{-- hero-section --}}
    <div class="hero-section bg-header_bg text-header_text pt-[50px] pb-[70px]">
        <div class="container mx-auto py-3 px-3">
            <h1 class="text-header_text text-4xl font-bold ">Hi there 👋</h1>
            <p class="text-header_text text-lg">together we can discuss new ideas, suggestions and solve issues to make our
                service
                even better for you.</p>
        </div>
    </div>

    {{-- page-action- --}}
    <div class="page-action">
        <div class="container mx-auto py-3 px-3">
            <div class="inner flex justify-between items-center bg-white rounded-lg shadow-lg -mt-[35px] p-3">
                <div class="search-area relative w-full">
                    <div class="icon absolute left-0 top-[8px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="ionicon w-[25px] opacity-50">
                            <title>Search</title>
                            <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none"
                                stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                stroke-width="32" d="M338.29 338.29L448 448"></path>
                        </svg>
                    </div>
                    <form action="{{ route('feedback.index') }}">

                        <input name="query" value="{{request()->query('query')}}" type="text"
                            class="border-none ring-0 shadow-none focus:ring-0 w-full pl-[30px] text-sm"
                            id="search_feedback" placeholder="Search...">
                    </form>
                </div>
                <div class="create-post-area pr-[30px] text-sm min-w-[150px]">
                    @auth
                        <a href="{{ route('feedback.create') }}" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="ionicon w-[20px] opacity-50">
                                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z"
                                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" d="M256 176v160M336 256H176"></path>
                            </svg>
                            <span class="inline-block ml-2">
                                <span class="text-sm font-[500]">Create a Post</span>
                            </span>
                        </a>
                    @else
                        <button data-modal-target="top-left-modal" data-modal-toggle="top-left-modal" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="ionicon w-[20px] opacity-50">
                                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z"
                                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" d="M256 176v160M336 256H176"></path>
                            </svg>
                            <span class="inline-block ml-2">
                                <span class="text-sm font-[500]">Create a Post</span>
                            </span>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- feedback-area --}}
    <div>
        <div class="container mx-auto mt-7">
            <div class="filter mb-4 576:mx-[18px]">
                Tags:
                <a href="{{ route('feedback.index') . '?query=trending' }}"
                    class="border border-gray-300 rounded-sm py-1 px-2 text-sm">Top</a>
                <a href="{{ route('feedback.index') }}"
                    class="border border-gray-300 rounded-sm py-1 px-2 text-sm">Newest</a>
            </div>
            <div class="feedback-area bg-white shadow-lg rounded-lg">
                @csrf
                @forelse ($features as $feature)
                    <div class="single-feedback flex border-b py-9 ">
                        <x-vote-actions :$feature />
                        <div class="feedback pr-2 w-full">
                            <div class="flex items-start justify-between w-full mb-2">
                                <a href="{{ route('feedback.show', $feature) }}"
                                    class="feedback-text text-base min-576:text-lg font-[500]">
                                    {{ $feature->title }}
                                </a>

                                @auth
                                    <div>
                                        @admin
                                            <button hx-post="{{ route('feedback.destroy', $feature) }}"
                                                hx-vals='{"_token": "{{ csrf_token() }}", "_method": "delete"}'
                                                hx-target="closest .single-feedback" hx-swap="delete" type="button"
                                                class="text-white bg-danger transition-all hover:bg-danger-hover focus:ring-4 focus:outline-none focus:ring-danger-light font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 dark:bg-danger-hover dark:hover:bg-danger dark:focus:ring-danger-light gap-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M2.75 6.167c0-.46.345-.834.771-.834h2.665c.529-.015.996-.378 1.176-.916l.03-.095l.115-.372c.07-.228.131-.427.217-.605c.338-.702.964-1.189 1.687-1.314c.184-.031.377-.031.6-.031h3.478c.223 0 .417 0 .6.031c.723.125 1.35.612 1.687 1.314c.086.178.147.377.217.605l.115.372l.03.095c.18.538.74.902 1.27.916h2.57c.427 0 .772.373.772.834c0 .46-.345.833-.771.833H3.52c-.426 0-.771-.373-.771-.833" />
                                                        <path fill="currentColor"
                                                            d="M11.607 22h.787c2.707 0 4.06 0 4.941-.863c.88-.864.97-2.28 1.15-5.111l.26-4.081c.098-1.537.147-2.305-.295-2.792c-.442-.487-1.187-.487-2.679-.487H8.23c-1.491 0-2.237 0-2.679.487c-.441.487-.392 1.255-.295 2.792l.26 4.08c.18 2.833.27 4.248 1.15 5.112C7.545 22 8.9 22 11.607 22"
                                                            opacity=".5" />
                                                    </svg>
                                                </span>
                                                Delete
                                            </button>
                                        @endadmin
                                        @if (auth()->user()->is_admin || $feature->user_id == auth()->id())
                                            <button
                                                x-on:click="$refs.form.setAttribute('action', '{{ route('feedback.update', $feature) }}')"
                                                hx-get="{{ route('feedback.edit', $feature) }}" hx-target="#hx-update-target"
                                                hx-select="#hx-select-fields" data-modal-target="default-modal"
                                                data-modal-toggle="default-modal" type="button"
                                                class="text-white bg-primary transition-all hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-primary-light font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 dark:bg-primary-hover dark:hover:bg-primary dark:focus:ring-primary-light gap-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="m11.4 18.161l7.396-7.396a10.289 10.289 0 0 1-3.326-2.234a10.29 10.29 0 0 1-2.235-3.327L5.839 12.6c-.577.577-.866.866-1.114 1.184a6.556 6.556 0 0 0-.749 1.211c-.173.364-.302.752-.56 1.526l-1.362 4.083a1.06 1.06 0 0 0 1.342 1.342l4.083-1.362c.775-.258 1.162-.387 1.526-.56c.43-.205.836-.456 1.211-.749c.318-.248.607-.537 1.184-1.114m9.448-9.448a3.932 3.932 0 0 0-5.561-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.092 3.32a8.754 8.754 0 0 0 3.431 2.13z" />
                                                    </svg>
                                                </span>
                                                Edit
                                            </button>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-sm gap-2 items-center">
                                                                                <img src="{{ $feature->user?->avatar ?? asset('assets/img/user.png') }}" alt="user"
                                                class="w-[20px] rounded-2xl">

                                    <span
                                        class="grow">{{ $feature->user?->name ?? 'Anonymous User' }}</span>
                                </div>
                                <div class="text-lg font-bold text-gray-400">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M156 128a28 28 0 1 1-28-28a28 28 0 0 1 28 28"/></svg>
                                </div>
                                <span
                                    class="text-sm opacity-60 inline-block mr-2">{{ $feature->created_at->diffForHumans() }}</span>
                                <div class="text-sm text-gray-400 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none"><path fill="currentColor" d="M12 21a9 9 0 1 0-9-9c0 1.488.36 2.89 1 4.127L3 21l4.873-1c1.236.639 2.64 1 4.127 1" opacity=".16"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0-9-9c0 1.488.36 2.89 1 4.127L3 21l4.873-1c1.236.639 2.64 1 4.127 1"/></g></svg>
                                <span class="text-gray-500">{{$feature->comments_count}}</span>
                                </div>
                            </div>
                            <div class="feedback-progress mt-[10px] flex gap-4 items-center" x-data="{ show: false }">
                                <span
                                    class="completed bg-primary text-white rounded-xl py-1 px-2 text-[10px] font-semibold">Feature</span>
                                    @if (auth()->user()?->is_admin)
                                        <div @click="show = !show"
                                            class="flex gap-1 items-center completed {{ $feature->status == 'in progress' ? 'bg-yellow-200 text-yellow-500' : 'bg-success text-white' }} rounded-xl py-1 px-2 text-[10px] font-semibold capitalize">
                                            {{ $feature->status }}
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="m11.4 18.161l7.396-7.396a10.289 10.289 0 0 1-3.326-2.234a10.29 10.29 0 0 1-2.235-3.327L5.839 12.6c-.577.577-.866.866-1.114 1.184a6.556 6.556 0 0 0-.749 1.211c-.173.364-.302.752-.56 1.526l-1.362 4.083a1.06 1.06 0 0 0 1.342 1.342l4.083-1.362c.775-.258 1.162-.387 1.526-.56c.43-.205.836-.456 1.211-.749c.318-.248.607-.537 1.184-1.114m9.448-9.448a3.932 3.932 0 0 0-5.561-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.092 3.32a8.754 8.754 0 0 0 3.431 2.13z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <x-select hx-post="{{ route('feature.update.status', $feature) }}"
                                            hx-include="[name='_token']" hx-target="body" ::class="show ? '' : '!hidden'"
                                            value="{{ $feature->status }}" class="capitalize" name="status"
                                            placeholder="Change Status" :items="array_column(\App\Enums\FeatureStatusEnum::cases(), 'value')">
                                        </x-select>
                                        @method('PUT')
                                        @else
                                        <div class="flex gap-1 items-center completed {{ $feature->status == 'in progress' ? 'bg-yellow-200 text-yellow-500' : 'bg-success text-white' }} rounded-xl py-1 px-2 text-[10px] font-semibold capitalize">
                                            {{ $feature->status }}
                                            </div>
                                    @endif


                            </div>

                        </div>
                    </div>
                @empty
                   <div class="flex min-h-24 items-center justify-center text-gray-400 font-bold">
                   No Feedback Found!
                   </div>
                @endforelse
            </div>
            <div class="flex items-center justify-center htmx-indicator h-40">
                <x-loader class="w-8 h-8" />
            </div>
        </div>
    </div>
@endsection
