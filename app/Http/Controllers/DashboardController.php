<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $pendingBorrows = Borrow::where('status', 'pending')->get();
            return view('dashboard.admin.dashboard', compact('pendingBorrows'));
        }

        $books = Book::latest()->paginate(10);
        return view('dashboard.user.dashboard', compact('books'));
    }
    public function borrow(Request $request)
    {
        $book = Book::where('slug', $request->slug)->first();
        if (!$book) {
            return redirect()->route('dashboard.index')->with('error', 'Book not found');
        }

        return view('dashboard.user.borrow', compact('book'));
    }
}