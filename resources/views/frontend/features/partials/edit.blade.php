@extends('layouts.frontend.app')

@section('content')
    <div class="flex items-center justify-center px-4 md:px-0 my-8">
        <form action="{{ route('feedback.store') }}" method="post" class="max-w-3xl mx-auto">
            @csrf
            <div class="grid grid-cols-3 gap-4" id="hx-select-fields">
                <div class="mb-2 col-span-2">
                    <x-input label="Title" type="text" name="title" :value="$feature->title" placeholder="Title" class="w-full" />
                </div>
                <div class="mb-2 col-span-1">
                    <x-select value="{{$feature->priority}}" label="Choose Priority" class="capitalize" name="priority" placeholder="Choose Priority"
                        :items="array_column(\App\Enums\FeaturePriorityEnum::cases(), 'value')">
                    </x-select>
                </div>
                <div class="mb-2 col-span-3">
                    <x-editor placeholder="Body" name="body" cols="30" rows="10">{!!$feature->body!!}</x-editor>
                </div>
            </div>
            <button class="bg-primary rounded hover:bg-primary-soft px-2 py-1 text-white font-bold"
                type="submit">Submit</button>
        </form>
    </div>
@endsection
