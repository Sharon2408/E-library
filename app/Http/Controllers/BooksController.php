<?php

namespace App\Http\Controllers;

use App\Models\BookShelf;
use App\Models\User;
use Illuminate\Database\QueryException;
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
        try {
            $books = Book::where('category_id', $category_id)->get();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return view('library.book', compact('books'));
    }

    public function getBooks(Request $request, Book $book)
    {
        try {
            $books = Book::paginate(4);
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return view('admin.book', compact('books'));
    }

    public function createBook()
    {
        try {
            $book = new Book();
            $category = Category::all();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return view('admin/createbook', compact('category', 'book'));
    }


    public function store(Request $request)
    {
        try {
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
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return redirect('admin/book');
    }


    public function show(Book $book, Category $category)
    {
        try {
            $books = Book::all();
            $categories = Category::all();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return view('admin/editbook', compact('book', 'category', 'books', 'categories'));
    }

    public function update(Book $book, Request $request)
    {
        try {
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
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return redirect('admin/book')->with('edit-feedback', 'Its already in your Shelf');
    }
    public function destroy($id)
    {
        try {
            $book = Book::where('id', $id);
            $book->delete();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return redirect('admin/book');
    }

    public function singleBookView($book_id)
    {
        try {
            $book = Book::where('id', $book_id)->get();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('error');
        }
        return view('library/singlebookview', compact('book'));

    }

    public function bookShelf($book_id)
    {
        $userid = auth()->user()->id;
        $books = Book::select('id')->get();
        foreach ($books as $book) {
            if ($book_id == $book->id) {
                return redirect()->back()->with('bookExists-feedback', 'Its already in your Shelf');
            } else {
                BookShelf::create([
                    "user_id" => $userid,
                    "book_id" => $book_id,
                ]);
                return redirect()->back();
            }
        }
    }

    public function viewBookShelf()
    {
        $userid = auth()->user()->id;
        $books = DB::table('books')
            ->join('book_shelves', 'book_shelves.book_id', '=', 'books.id')
            ->where('book_shelves.user_id', '=', $userid)
            ->get();
        // dd($books);
        return view('library/bookshelf', compact('books'));

    }

}