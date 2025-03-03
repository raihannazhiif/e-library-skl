<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view("books.index", compact("books"));
    }

    public function create()
    {
        return view("books.create");
    }
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            "title" => "required|unique:books|min:3|max:255",
            "description" => "required|min:3|max:255",
            "page_count" =>"required|numeric|min:1",
            "author" => "required|min:3|max:255",
            "published_year" => "required|numeric|digits:4",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ],[
            "title.required" => "JUDUL GAK OLEH KOSONG",
            "title.unique" => "JUDUL SUDAH ADA",
            "published_year.digits" => "TAHUN TERLALU PANJANG",
            "image.max" => "UKURAN GAMBAR TERLALU BESAR",
        ]);

        try {
            // get uploaded image
            $image = $request->file("image");
            // dd($image);
            // rename the uploaded image
            $renamedImage = time(). "-" . rand(1, 1000) .".". $image->getClientOriginalExtension();
            // store the image into specific folder
            $image->storeAs("book-images", $renamedImage,"public");

            $slugTitle = Str::slug($request->title);

            // $book = new Book();
            // $book->title = $request->title;
            // $book->slug = $slugTitle;
            // $book->description = $request->description;
            // $book->page_count = $request->page_count;
            // $book->author = $request->author;
            // $book->published_year = $request->published_year;
            // $book->image = $renamedImage;
            // $book->save();

            $book = Book::create([
                "title"=> $request->title,
                "slug" => $slugTitle,
                "description" => $request->description,
                "page_count" => $request->page_count,
                "author" => $request->author,
                "published_year" => $request->published_year,
                "image"=> $renamedImage,
            ]);

            // dd($book);

            // $book = DB::table("books")->insert([
            //     "title" => $request->title,
            //     "slug" => $slugTitle,
            //     "description" => $request->description,
            //     "page_count" => $request->page_count,
            //     "author" => $request->author,
            //     "published_year" => $request->published_year,
            //     "image" => $renamedImage,
            //     ]);

            if ($book) {
            return redirect()->route("book.index")->with("success", "Book created successfully");
            } else {
                throw new \Exception("Failed to create book");
            }

        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage())->withInput(request()->all());
        }
    }
}
