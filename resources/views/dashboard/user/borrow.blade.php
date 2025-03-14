@extends('layout.app')

@section('title')
    Borrow | {{$book->title}}
@endsection

@section('content')
<section class="p-4">
    <h1 class="text-4xl font-bold text-blue-800">Borrow Book</h1>

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
            <div>
                <h2 class="font-bold text-blue-800">Borrow Count :</h2>
                <p>{{ $book->borrow_count }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Availability :</h2>
                <p>{{ $book->status }}</p>
            </div>
            <div class="text-right">
                <h2 class="font-bold text-blue-800">Approximate Return Date</h2>
                <p>{{ now()->addDays(7)->format('l, j F Y h:i a') }}</p>
            </div>
            <div class="text-right">
                <form action={{route('borrow.request', $book->id)}} method="POST">
                    @csrf
                    <button type="submit" class="p-4 bg-blue-500 text-white rounded-md">Proceed to Borrow</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection