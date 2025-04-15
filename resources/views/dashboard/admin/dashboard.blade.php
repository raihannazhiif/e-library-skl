@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
<main class="p-6 space-y-6 bg-gray-100 min-h-screen">

    <section class="bg-white rounded-xl shadow-lg p-6 space-y-2">
        <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-2">
            📊 Dashboard Admin
        </h1>
        <p class="text-lg text-gray-600">Manage book requests and library data efficiently.</p>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('book.index') }}"
            class="p-4 bg-blue-700 hover:bg-blue-800 text-white rounded-xl shadow-md transition-all flex items-center justify-center gap-3 text-lg font-semibold">
            📚 Book List
        </a>
        <a href="#"
            class="p-4 bg-blue-700 hover:bg-blue-800 text-white rounded-xl shadow-md transition-all flex items-center justify-center gap-3 text-lg font-semibold">
            📝 Borrow List
        </a>
    </section>

    <section class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">📥 Pending Borrow Requests</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Book Title</th>
                        <th class="py-3 px-4">Request Date</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingBorrows as $pending)
                        <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 transition-all border-b">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $pending->user->name }}</td>
                            <td class="py-3 px-4">{{ $pending->book->title }}</td>
                            <td class="py-3 px-4">{{ $pending->created_at->format('l, j F Y H:i') }}</td>
                            <td class="py-3 px-4 flex justify-center items-center gap-2">
                                <form action="{{ route('borrow.accept') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $pending->id }}">
                                    <button type="submit"
                                        class="flex items-center gap-1 px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-medium transition">
                                        ✅ Accept
                                    </button>
                                </form>

                                <form action="{{ route('borrow.decline') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $pending->id }}">
                                    <button type="submit"
                                        class="flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium transition">
                                        ❌ Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-gray-500 italic">No pending requests at the moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
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
                style: {
                    background: "#16a34a",
                    border: "1px solid #15803d",
                },
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
                    style: {
                        background: "#dc2626",
                        border: "1px solid #b91c1c",
                    },
                }).showToast();
            </script>
        @endforeach
    @endif
@endsection
