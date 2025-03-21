<div class="flex justify-between items-center p-4 shadow bg-blue-800 text-white">
    {{-- Logo --}}
    <a href="/" class="font-bold text-3xl tracking-wide hover:text-yellow-400 transition-all">
        📚 E-Library
    </a>

    {{-- Navigations --}}
    <nav class="flex gap-4 items-center">
        @auth
            <div class="flex items-center gap-2">
                <span class="font-semibold">{{ auth()->user()->name }}</span>
                <form action={{ route('logout') }} method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-500 px-3 py-1 rounded-md text-white hover:bg-red-600 transition-all">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <a href={{ route('sign-in-form') }}
               class="bg-green-500 px-4 py-2 rounded-md hover:bg-green-600 transition-all">
                Sign In
            </a>
            <a href={{ route('sign-up-form') }}
               class="bg-yellow-500 px-4 py-2 rounded-md hover:bg-yellow-600 transition-all">
                Sign Up
            </a>
        @endauth
    </nav>
</div>