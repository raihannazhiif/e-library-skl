@extends('layout.app')

@section('title')
    {{ $book->title }}
@endsection

@section('content')

<section class="p-4 flex flex-col gap-4">
    <button type="button" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium" onclick="history.back()">
        Back
    </button>
    {{-- <a href="{{ route('book.index') }}" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Home</a> --}}
    
    <h1 class="text-4xl font-bold text-blue-800">{{ $book->title }}</h1>

    <div class="grid grid-cols-7 gap-4">
        <img src={{ asset('storage/book-images/' . $book->image) }} alt={{ $book->title }} class="col-span-3 w-full" />

        <div class="flex flex-col gap-4 text-xl col-span-4">
            <div>
                <h2 class="font-bold text-blue-800">Title :</h2>
                <p>{{ $book->title }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Description :</h2>
                <p>{{ $book->description }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Total Page :</h2>
                <p>{{ $book->page_count }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Author :</h2>
                <p>{{ $book->author }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Published Year :</h2>
                <p>{{ $book->published_year }}</p>
            </div>
        </div>
    </div>
</section>

@endsection