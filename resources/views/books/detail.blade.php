@extends('layout.app')

@section('title')
    {{ $book->title }}
@endsection

@section('content')

<section class="p-4 flex flex-col gap-6">
  <div class="flex gap-2">
    <button type="button" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium flex items-center gap-2"
      onclick="history.back()">
      ⬅️ Back
    </button>
    <a href="{{ route('book.index') }}" class="p-2 bg-green-700 text-white rounded-md w-fit font-medium flex items-center gap-2">
      🏠 Home
    </a>
  </div>

  <h1 class="text-5xl font-bold text-blue-800">{{ $book->title }}</h1>

  <div class="grid grid-cols-7 gap-6">
    <img src={{ asset('storage/book-images/' . $book->image) }} alt={{ $book->title }}
      class="col-span-3 w-full rounded-lg shadow-lg" />

    <div class="flex flex-col gap-6 text-lg col-span-4">
      <div>
        <h2 class="font-bold text-blue-800">📖 Title :</h2>
        <p>{{ $book->title }}</p>
      </div>
      <div>
        <h2 class="font-bold text-blue-800">📝 Description :</h2>
        <p>{{ $book->description }}</p>
      </div>
      <div>
        <h2 class="font-bold text-blue-800">📄 Total Page :</h2>
        <p>{{ $book->page_count }}</p>
      </div>
      <div>
        <h2 class="font-bold text-blue-800">✍️ Author :</h2>
        <p>{{ $book->author }}</p>
      </div>
      <div>
        <h2 class="font-bold text-blue-800">📅 Published Year :</h2>
        <p>{{ $book->published_year }}</p>
      </div>
    </div>
  </div>
</section>


@endsection