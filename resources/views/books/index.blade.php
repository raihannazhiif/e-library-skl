@extends('layout.app')

@section('title')
    Books
@endsection

@section('content')
<section class="p-4 flex flex-col gap-4">
    <h1 class="text-4xl font-bold text-blue-800">Book List</h1>
    <a href="{{ route('create-book') }}" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">New Book</a>
    <table class="p-4 border border-black">
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="p-2">No</th>
                <th class="p-2">Title</th>
                <th class="p-2">Author</th>
                <th class="p-2">Year</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book )
                <tr class="border">
                    <td class="text-center p-2">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
                    <td class="p-2">{{ $book->title }}</td>
                    <td class="p-2">{{ $book->author }}</td>
                    <td class="text-center p-2">{{ $book->published_year }}</td>
                    <td class="p-2 flex gap-2 justify-center items-center">
                        <a href="#" class="p-2 bg-slate-500 text-white rounded-md">Detail</a>
                        <a href="#" class="p-2 bg-blue-500 text-white rounded-md">Update</a>
                        <a href="#" class="p-2 bg-red-500 text-white rounded-md">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-center">
        {{ $books->links() }}
    </div>

</section>

@endsection

@section('js')
@if (session('success'))
<script>
    Toastify({
        text: "{{ session('success') }}",
        // text: "TEST",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "green",
            border: "1px solid green",
        },
        onClick: function(){}
    }).showToast();
</script>
@endif
@endsection