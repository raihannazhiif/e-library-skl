@extends('layout.app')

@section('title')
Sign In
@endsection

@section('content')
    
<main class="p-10 mx-auto w-fit">
    <h1 class="font-bold text-4xl text-center mb-10">Sign In</h1>
    
    <form action={{route('login')}} method="POST" class="flex flex-col gap-4 max-w-full w-[640px] bg-white rounded p-6 shadow">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="p-2 border" />
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-2 border" />
        
        <button type="submit" class="p-2 bg-blue-600 hover:bg-blue-800 text-white rounded">Continue</button>
    </form>
</main>

@endsection

@section('js')
@if ($errors->any())
@foreach ($errors->all() as $error )
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