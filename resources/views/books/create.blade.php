@extends('layout.app')

@section('title')
    New Book
@endsection

@section('content')
<section class="p-4 flex flex-col gap-4">
    <h1 class="text-4xl font-bold text-blue-800">New Book</h1>

    @if ($errors->any())
    <div class="space-y-2">
        @foreach ($errors->all() as $error)
        <div class="p-4 bg-red-500 text-white rounded-md font-medium">
            {{ $error }}
        </div>
        @endforeach
    </div>
    @endif

    <form action={{ route('store-book') }} method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="title" class="font-bold">Title</label>
            <input type="text" name="title" id="title" class="border border-black p-2" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="description" class="font-bold">Description</label>
            <textarea type="text" name="description" id="description" class="border border-black p-2"></textarea>
        </div>
        <div class="flex flex-col gap-2">
            <label for="page_count" class="font-bold">Pages</label>
            <input type="number" name="page_count" id="page_count" class="border border-black p-2" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="author" class="font-bold">Author</label>
            <input type="text" name="author" id="author" class="border border-black p-2" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="published_year" class="font-bold">Year</label>
            <input type="number" name="published_year" id="published_year" class="border border-black p-2" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="image" class="font-bold">Image</label>
            <input type="file" accept="image/*" name="image" id="image" class="border border-black p-2" />
        </div>
        <button type="submit" class="p-4 bg-blue-800 text-white rounded-md font-semibold">Add</button>
    </form>
</section>
@endsection