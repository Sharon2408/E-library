<?php

namespace App\Http\Controllers;

use App\Models\BookShelf;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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
        
            return view('library/error');
        }
        return view('library.book', compact('books'));
    }

    public function getBooks(Request $request, Book $book)
    {
       
        try {
            if (auth()->user()->email !== 'admin@gmail.com') {
                return abort(403); 
            }
            $books = Book::paginate(4);
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('library/error');
        }
       
        return view('admin.book', compact('books'));
        
    }

    public function createBook()
    {
        try {
            $book = new Book();
            $category = Category::all();
        } catch (QueryException $q) {
            
            return view('library/error');
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
                'pdf' => 'file|max:5000',
                'ispremium' => 'required'
            ]);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('book_images', 'public');
            }
            if ($request->hasFile('pdf')) {
                $data['pdf'] = $request->file('pdf')->store('books', 'public');
            }

            $book = Book::create($data);
        } catch (QueryException $q) {
            
        //    return view('library/error');
        }
        return redirect('admin/book')->with('book-added','Book was Added Successfully');
    }


    public function show(Book $book, Category $category)
    {
        try {
            $books = Book::all();
            $categories = Category::all();
        } catch (QueryException $q) {
            
            return view('library/error');
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
            
            return view('library/error');
        }
        return redirect('admin/book')->with('book-updated','Book Details Updated Successfully');
    }
    public function softDelete($id)
    {
        try {
            $book = Book::where('id', $id);
            $book->delete();
        } catch (QueryException $q) {
            
            return view('library/error');
        }
        return redirect('admin/book')->with('book-deleted','Book was Deleted Successfully');
    }



    public function singleBookView($book_id)
    {
        try {
            $book = Book::where('id', $book_id)->get();
        } catch (QueryException $q) {
            
            return view('error');
        }
        return view('library/singlebookview', compact('book'));

    }

    public function showDeletedBooks()
    {
      //  try {
            $books = Book::whereNotNull('deleted_at')->get();
      //  } 
      //  catch (QueryException $q) {
          //  return view('/library/error');
      //  }
        return view('/admin/showdeleted', compact('books'));
    }

    public function restore(){
        $data = Book::withTrashed();
        $data->restore();
        return redirect()->back()->with('book-restored','Books Restored Successfully');
    }


}