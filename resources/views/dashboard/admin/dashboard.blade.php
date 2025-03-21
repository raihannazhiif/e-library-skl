@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="flex flex-col gap-6 p-6">
        <h1 class="text-4xl font-bold text-blue-800 flex items-center gap-2">
            📊 Dashboard Admin
        </h1>
        <p class="text-lg text-gray-600">Manage book requests and library data</p>

        <div class="grid grid-cols-2 gap-4">
            <a href={{ route('book.index') }} class="p-3 bg-blue-800 text-white rounded-md w-full text-center font-medium flex items-center gap-2">
                📚 Book List
            </a>
            <a href="#" class="p-3 bg-blue-800 text-white rounded-md w-full text-center font-medium flex items-center gap-2">
                📝 Borrow List
            </a>
        </div>

        {{-- Table Request Borrow --}}
        <table class="border border-black w-full text-center">
            <thead>
                <tr class="bg-blue-800 text-white">
                    <th class="p-3">No</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Book Title</th>
                    <th class="p-3">Request Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($pendingBorrows->count() === 0)
                    <tr class="text-center">
                        <td colspan="5" class="p-4">No items</td>
                    </tr>
                @endif

                @foreach ($pendingBorrows as $pending)
                    <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }} hover:bg-neutral-200 border-b">
                        <td class="p-3">{{ $loop->index + 1 }}</td>
                        <td class="p-3">{{ $pending->user->name }}</td>
                        <td class="p-3">{{ $pending->book->title }}</td>
                        <td class="p-3">{{ $pending->created_at->format('l, j F Y H:i') }}</td>
                        <td class="p-3 flex gap-2 justify-center">
                            <form action={{ route('borrow.accept') }} method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value={{ $pending->id }}>
                                <button type="submit"
                                    class="p-2 bg-green-600 text-white rounded-md font-medium">✅ Accept</button>
                            </form>

                            <form action={{ route('borrow.decline') }} method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value={{ $pending->id }}>
                                <button type="submit"
                                    class="p-2 bg-red-600 text-white rounded-md font-medium">❌ Decline</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection

@section('js')
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
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
