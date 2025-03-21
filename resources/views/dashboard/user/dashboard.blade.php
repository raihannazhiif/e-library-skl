@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')

<section class="p-6 bg-gray-100 min-h-screen">
  <div class="bg-white p-6 rounded-2xl shadow-md">
    <h1 class="text-3xl font-bold text-blue-800">Welcome, {{ auth()->user()->name }}</h1>
    <p class="font-semibold text-xl mt-2">Your personalized E-Library dashboard</p>

    <h2 class="text-4xl font-extrabold mt-8 text-gray-800">Book List</h2>

    <div class="overflow-x-auto mt-4">
      <table class="table-auto w-full border border-gray-300 rounded-md shadow-sm">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="p-3">No</th>
            <th class="p-3">Title</th>
            <th class="p-3">Cover</th>
            <th class="p-3">Author</th>
            <th class="p-3">Year</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($books as $book)
            <tr class="border-b hover:bg-blue-50">
              <td class="text-center p-3">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
              <td class="p-3">{{ $book->title }}</td>
              <td class="p-3">
                <img src={{ asset('storage/book-images/' . $book->image) }} alt="{{ $book->title }}" class="w-20 h-20 object-contain bg-gray-300 rounded-md" />
              </td>
              <td class="p-3">{{ $book->author }}</td>
              <td class="text-center p-3">{{ $book->published_year }}</td>
              <td class="p-3 flex gap-2 justify-center items-center">
                <a href={{ route('book.show', $book->slug) }} class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600">Detail</a>
                @if ($book->status == 'available')
                  <a href={{ route('dashboard.borrow', $book->slug) }} class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Borrow</a>
                @else
                  <button type="button" disabled class="p-2 bg-gray-400 text-white rounded-md cursor-not-allowed">Borrow</button>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center p-4 text-gray-500">No items available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="flex flex-col gap-4 justify-center items-center mt-6">
      <p class="text-gray-600">Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }}</p>
      <div class="flex gap-2">
        {{ $books->links() }}
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Toastify({
                    text: "{{ $error }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "red",
                        border: "1px solid red",
                    },
                    onClick: function() {}
                }).showToast();
            </script>
        @endforeach
    @endif
@endsection
