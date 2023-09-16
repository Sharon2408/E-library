<?php

namespace App\Http\Controllers;

use App\Models\BookShelf;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // Routing view Category wise
    public function index($category_id)
    {
        $books = Book::where('category_id', $category_id)->get();
        return view('library.book', compact('books'));
    }

    public function getBooks(Request $request, Book $book)
    {
        $books = Book::paginate(4);
        // $this->authorize('getBooks', $book);
        return view('admin.book', compact('books'));
    }

    public function createBook()
    {
        $book = new Book();
        $category = Category::all();
        return view('admin/createbook', compact('category', 'book'));
    }
    private function storeImage($book)
    {
        if (request()->has('image')) {
            $book->update([
                'image' => request()->image->store('book_images', 'public')
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'author' => 'required',
            'published_year' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required|file|image|max:10000',
            'pdf' => 'file|max:5000'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('book_images', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('books', 'public');
        }

        $book = Book::create($data);
        return redirect('admin/book');
    }


    public function show(Book $book, Category $category)
    {
        $books = Book::all();
        $categories = Category::all();
        return view('admin/editbook', compact('book', 'category', 'books', 'categories'));
    }

    public function update(Book $book, Request $request)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'author' => 'required',
            'published_year' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'file|image|max:10000',
            'pdf' => 'file|max:5000'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('book_images', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('books', 'public');
        }
        $book->update($data);
        return redirect('admin/book');
    }
    public function destroy($id)
    {
        $book = Book::where('id',$id);
        $book->delete();
        return redirect('admin/book');
    }

    public function premimumBooks()
    {
          
    }

    public function singleBookView($book_id)
    {

        $book = Book::where('id', $book_id)->get();
        return view('library/singlebookview', compact('book'));

    }

    public function bookShelf($book_id,Request $request)
    {
         $userid = auth()->user()->id;
        $books = Book::all();
        // dd($book);
         BookShelf::create([
            "user_id" => $userid,
            "book_id" => $book_id,
        ]);
        return redirect()->back();
    }

public function viewBookShelf(){
    $userid = auth()->user()->id;
    $books = DB::table('books')
    ->join('book_shelves', 'book_shelves.book_id', '=', 'books.id')
    ->where('book_shelves.user_id', '=', $userid)
    ->get();
   // dd($books);
return view('library/bookshelf',compact('books'));

}

}