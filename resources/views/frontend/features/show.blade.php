@extends('layouts.frontend.app')

@section('content')
    @php
        $hasUpvoted = $feature->votes->where('email', userEmail())->where('count', 1)->first();
        $hasDownvoted = $feature->votes
            ->where('email', userEmail())
            ->where('count', -1)
            ->first();
    @endphp
    <div class="container max-w-5xl mx-auto mt-8" x-data="{ parentId: null, replyTo: null }">
        <div class="gap-4">
            <div class="">
                {{-- feedback-header --}}
                <div class="feedback-header bg-primary text-white rounded-xl py-[30px] px-[22px]">
                    <div class="flex items-end justify-between gap-2">
                        <div>
                            <h3 class="font-bold min-576:text-[20px] mb-1">
                                {{ $feature->title }}
                            </h3>
                            <div class="body mb-4">
                                {!! $feature->body !!}
                            </div>

                            <div class="flex justify-between items-center mt-2">
                                <div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex gap-2 items-center mt-1">
                                            <img src="{{ $feature->user?->avatar ?? asset('assets/img/user.png') }}" alt="user"
                                                class="w-[20px] rounded-2xl">
                                            <span
                                                class="font-[500] grow">{{ $feature->user?->name ?? 'Anonymous User' }}</span>
                                        </div>
                                        <span
                                            class="text-sm opacity-60 inline-block mr-2">{{ $feature->created_at->diffForHumans() }}</span>
                                        {{-- <button class="text-sm flex gap-[3px] items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-[18px]">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                                    d="M12 6v4m-4.5 9c.655 1.748 2.422 3 4.5 3c.245 0 .485-.017.72-.05M16.5 19a4.498 4.498 0 0 1-1.302 1.84M9.107 2.674A6.52 6.52 0 0 1 12 2c3.727 0 6.75 3.136 6.75 7.005v.705a4.4 4.4 0 0 0 .692 2.375l1.108 1.724c1.011 1.575.239 3.716-1.52 4.214a25.775 25.775 0 0 1-14.06 0c-1.759-.498-2.531-2.639-1.52-4.213l1.108-1.725A4.4 4.4 0 0 0 5.25 9.71v-.705c0-1.074.233-2.092.65-3.002" />
                                            </svg>
                                            Subscribe
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-100 text-slate-800 rounded-lg -mt-4">
                            <x-vote-actions class="py-3" :$feature />
                        </div>
                    </div>
                </div>


                <div class="h-screen mb-4 relative w-full">
                    {{-- comment-area --}}
                    <div class="comment-area bg-white rounded-lg pt-[30px] mt-[20px] mb-20">
                        {{-- comments --}}
                        <div class="comments px-[22px]">
                            @forelse ($feature->comments as $comment)
                                <x-comment :$comment />
                            @empty
                                <div class="p-4 text-center text-slate-500 font-bold">
                                    No Comments Found
                                </div>
                            @endforelse

                        </div>
                    </div>
                    {{-- comment-submit-form --}}
                    <div
                        class="comment-submit-form border-t border-gray-300 px-[22px] py-[20px] bg-white fixed bottom-0 container max-w-5xl">
                        <form method="post" action="{{ route('comment.store') }}" class="flex items-center">
                            @csrf
                            <div class="text-sm" :class="replyTo == null ? 'hidden' : ''" x-text="'@'+replyTo"></div>
                            <x-editor  ::class="replyTo == null ? 'pl-[30px] ' : 'pl-2'" type="text"
                                name="body" id="" ::placeholder="replyTo == null ? 'Write a comment...' : ''"
                                class="border-none ring-0 shadow-none focus:ring-0 w-full"></x-editor>
                            <input type="hidden" name="parent_id" x-model="parentId">
                            <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                            <button class="submit-icon w-[20px]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="s-ion-icon">
                                    <path
                                        d="M452.1 49L52.3 265.3c-6 3.3-5.6 12.1.6 14.9l68.2 25.7c4 1.5 7.2 4.5 9 8.4l53 109.1c1 4.8 9.9 6.1 10 1.2l-8.1-90.2c.5-6.7 3-13 7.3-18.2l207.3-203.1c1.2-1.2 2.9-1.6 4.5-1.3 3.4.8 4.8 4.9 2.6 7.6L228 338c-4 6-6 11-7 18l-10.7 77.9c.9 6.8 6.2 9.4 10.5 3.3l38.5-45.2c2.6-3.7 7.7-4.5 11.3-1.9l99.2 72.3c4.7 3.5 11.4.9 12.6-4.9L463.8 58c1.5-6.8-5.6-12.3-11.7-9z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
