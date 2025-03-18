@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="flex flex-col gap-4 p-4">
        <h1 class="text-4xl font-bold text-blue-800">

            Dashboard Admin
        </h1>
        <a href={{ route('book.index') }} class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Book List</a>
        <a href="#" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Borrow List</a>
        {{-- Table Request Borrow --}}
        <table class="p-4 border border-black">
            <thead>
                <tr class="bg-blue-800 text-white">
                    <th class="p-2">No</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Book Title</th>
                    <th class="p-2">Request Date</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($pendingBorrows->count() === 0)
                    <tr class="text-center p-2">
                        <td colspan="5">
                            No items
                        </td>
                    </tr>
                @endif

                @foreach ($pendingBorrows as $pending)
                    <tr class="border-b border-neutral-500 hover:bg-neutral-200">
                        <td class="p-2">{{ $loop->index + 1 }}</td>
                        <td class="p-2">{{ $pending->user->name }}</td>
                        <td class="p-2">{{ $pending->book->title }}</td>
                        <td class="p-2">{{ $pending->created_at->format('l, j F Y H:i') }}</td>
                        <td class="p-2 flex gap-2">
                            <form action={{ route('borrow.accept') }} method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value={{ $pending->id }}>
                                <button type="submit"
                                    class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Accept</button>
                            </form>

                            <form action={{ route('borrow.decline') }} method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value={{ $pending->id }}>
                                <button type="submit"
                                    class="p-2 bg-red-800 text-white rounded-md w-fit font-medium">Decline</button>
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
