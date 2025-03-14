@extends('layout.app')

@section('title')
    Books
@endsection

@section('content')
    <section class="p-4 flex flex-col gap-4">
        <h1 class="text-4xl font-bold text-blue-800">Book List</h1>
        <a href="{{ route('book.create') }}" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">New Book</a>
        <table class="p-4 border border-black">
            <thead>
                <tr class="bg-blue-800 text-white">
                    <th class="p-2">No</th>
                    <th class="p-2">Title</th>
                    <th class="p-2">Cover</th>
                    <th class="p-2">Author</th>
                    <th class="p-2">Year</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($books->count() === 0)
                    <tr class="text-center p-2">
                        <td colspan="6">
                            No items
                        </td>
                    </tr>
                @endif
                @foreach ($books as $book)
                    <tr class="border">
                        <td class="text-center p-2">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}
                        </td>
                        <td class="p-2">{{ $book->title }}</td>
                        <td class="p-2">
                            <img src={{ asset('storage/book-images/' . $book->image) }} alt="{{ $book->title }}"
                                class="w-24 aspect-square object-contain bg-gray-400" />
                        </td>
                        <td class="p-2">{{ $book->author }}</td>
                        <td class="text-center p-2">{{ $book->published_year }}</td>
                        <td class="p-2 flex gap-2 justify-center items-center">
                            <a href={{ route('book.show', $book->slug) }} class="p-2 bg-slate-500 text-white rounded-md">Detail</a>
                            <a href={{ route('book.edit', $book->slug) }} class="p-2 bg-blue-500 text-white rounded-md">Edit</a>
                            {{-- <a href={{ route('delete-book', $book->id) }} class="p-2 bg-red-500 text-white rounded-md">Delete</a> --}}

                            <form action="{{ route('book.delete', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-500 text-white rounded-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex flex-col gap-4 justify-center items-center">
            <p>
                Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }}
            </p>
            <div class="flex justify-center">
                <div class="flex gap-2">
                    {{-- Previous Button --}}
                    @if ($books->onFirstPage())
                        <span class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $books->previousPageUrl() }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            Prev
                        </a>
                    @endif

                    {{-- Button Angka2 --}}
                    @php
                        $currentPage = $books->currentPage();
                        $lastPage = $books->lastPage();
                        $maxVisiblePages = 3;

                        if ($lastPage <= $maxVisiblePages) {
                            $startPage = 1;
                            $endPage = $lastPage;
                        } else {
                            if ($lastPage <= ceil($maxVisiblePages / 2)) {
                                $startPage = 1;
                                $endPage = $maxVisiblePages;
                            } elseif ($currentPage >= $lastPage - floor($maxVisiblePages / 2)) {
                                $startPage = $lastPage - $maxVisiblePages + 1;
                                $endPage = $lastPage;
                            } else {
                                $startPage = $currentPage - floor($maxVisiblePages / 2);
                                $endPage = $currentPage + floor($maxVisiblePages / 2);
                            }
                        }
                    @endphp

                    @if ($startPage > 1)
                        <a href="{{ $books->url(1) }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            1
                        </a>
                        @if ($startPage > 2)
                            <span class="p-2 min-w-10 text-center">...</span>
                        @endif
                    @endif

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        @if ($i == $currentPage)
                            <span
                                class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}"
                                class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="p-2 min-w-10 text-center">...</span>
                        @endif
                        <a href="{{ $books->url($lastPage) }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            {{$lastPage}}
                        </a>
                    @endif


                    {{-- Next Button --}}
                    @if ($books->hasMorePages())
                        <a href="{{ $books->nextPageUrl() }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            Next
                        </a>
                    @else
                        <span class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
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
                onClick: function() {}
            }).showToast();
        </script>
    @endif
@endsection
