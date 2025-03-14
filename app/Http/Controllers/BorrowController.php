<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function request(Request $request)
    {
        $book = Book::find($request->id);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found');
        }

        try {
            if($book->status == 'unavailable'){
                throw new \Exception('Book is not available');
            }
            
            $returnedAt = now()->addDays(7);
            $user = Auth::user();
            $borrow = $user->borrows()->create([
                'book_id' => $book->id,
                'returned_at' => $returnedAt,
            ]);

            if ($borrow) {
                $borrow->book()->update(['status' => 'unavailable']);
                return redirect()->route('dashboard.index')->with('success','Book borrowed successfully');
            } else {
                throw new \Exception('Failed to borrow book');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
