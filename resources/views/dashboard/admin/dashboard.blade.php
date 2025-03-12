@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <main>
        Dashboard Admin
        <a href={{ route('book.index') }} class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Book List</a>
    </main>
@endsection
