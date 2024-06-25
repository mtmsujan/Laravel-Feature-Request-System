@php
    $hasUpvoted = $feature->votes->where('email', userEmail())->where('count', 1)->first();
    $hasDownvoted = $feature->votes
        ->where('email', userEmail())
        ->where('count', -1)
        ->first();
    $id = 'feature-' . $feature->id;
@endphp
<div class="vote-area px-6 flex flex-col items-center rounded-lg {{ $attributes->get('class') }}"
    id="{{ $id }}">
    <button class="vote-button-plus {{ $hasDownvoted == null && $hasUpvoted ? 'text-green-500' : '' }}"
        @auth
hx-post="{{ route('feature.vote', ['type' => 'up', 'feedback' => $feature]) }}" hx-target="#{{ $id }}" hx-select="#{{ $id }}" hx-swap="outerHTML"
    hx-include="input[name='_token']"
    @else
    data-modal-target="top-left-modal"
    data-modal-toggle="top-left-modal" type="button" @endauth>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="m12.37 8.165l6.43 6.63c.401.414.158 1.205-.37 1.205H5.57c-.528 0-.771-.79-.37-1.205l6.43-6.63a.499.499 0 0 1 .74 0" />
        </svg>
    </button>
    <div class="vote-count mx-auto">{{ $feature->votes->sum('count') ?? 0 }}</div>
    <button class="vote-button-minus {{ $hasUpvoted == null && $hasDownvoted ? 'text-rose-500' : '' }}"
        @auth
hx-post="{{ route('feature.vote', ['type' => 'down', 'feedback' => $feature]) }}"
        hx-target="#{{ $id }}" hx-select="#{{ $id }}" hx-swap="outerHTML" hx-include="input[name='_token']" 
        @else
    data-modal-target="top-left-modal"
    data-modal-toggle="top-left-modal" type="button" @endauth>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="m12.37 15.835l6.43-6.63C19.201 8.79 18.958 8 18.43 8H5.57c-.528 0-.771.79-.37 1.205l6.43 6.63c.213.22.527.22.74 0" />
        </svg>
    </button>
</div>
