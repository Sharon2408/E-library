<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Category Display on Home View
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = '';
        return view('/home', compact('categories','query'));
        
    }

    // Routing view Category wise
    public function showCategory($category_id)
    {
        $books = Book::where('category_id', $category_id)->get();
        return view('library.book', compact('books'));
    }

    public function getBooks()
    {
        $books = Book::all();
        return view('admin.book', compact('books'));
    }

    public function category()
    {
        $book = new Book();
        $category = Category::all();
        return view('admin/createbook', compact('category', 'book'));
    }
    private function storeImage($book){
        if(request()->has('image')){
          $book->update([
            'image' => request()->image->store('book_images','public')
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
        return redirect('admin/createbook');
    }


    public function show(Book $book, Category $category)
    {
        $books = Book::all();
        $categories = Category::all();
        return view('admin/editbook', compact('book','category','books','categories'));
    }

    public function update(Book $book,Request $request){
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
       public function destroy(Book $book){
        $book -> delete();
        return redirect('admin/book');
       }

}