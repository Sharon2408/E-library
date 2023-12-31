<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookShelf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookShelfController extends Controller
{
    public function index(){

    }
    public function bookShelf($book_id)
    {
        $userid = auth()->user()->id;
        $books = BookShelf::where('user_id', $userid)->where('book_id', $book_id)->first();
        if(!$books){

                BookShelf::create([
                    "user_id" => $userid,
                    "book_id" => $book_id,
                ]);
                return redirect()->back()->with('book-shelf', 'Added to your book shelf');
            }
            else{
                return redirect()->back()->with('book-shelf-exist', 'This book is already in your bookshelf');
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

    public function destroy($book_shelf_id){
        try {
            $book = BookShelf::where('id', $book_shelf_id)->get();
           // dd($book);
             $book->each->delete();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('library/error');
        }
        return redirect()->back()->with('book-shelf-removed', 'Removed from book shelf');
    }


}
