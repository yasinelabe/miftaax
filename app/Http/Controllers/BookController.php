<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookType;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $list = true;
        return view('books.index', compact('books', 'list'));
    }
    public function create()
    {
        $book_category_ids = BookCategory::all();
        $book_type_ids = BookType::all();
        return view('books.create', compact('book_category_ids', 'book_type_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['book_title' => 'required',  'book_category_id' => 'required', 'book_type_id' => 'required', 'shelf' => 'required', 'author_name' => 'required','qty'=>'required']);
        $book = new Book();
        if(isset($request->cover_image)){
            $file = $request->file('cover_image');
            $filename = $file->getClientOriginalName();
            //Move Uploaded File
            $destinationPath = 'uploads/book_images';
            $file->move($destinationPath, $file->getClientOriginalName());

            $book->cover_image = $filename;
        }
        $book->book_title = $request->book_title;
        $book->book_category_id = $request->book_category_id;
        $book->book_type_id = $request->book_type_id;
        $book->shelf = $request->shelf;
        $book->author_name = $request->author_name;
        $book->qty = $request->qty;
        $book->save();
        return redirect()->route('books.index');
    }
    public function show(Book $book)
    {
        return view('books.show', compact('book',));
    }
    public function edit(Book $book)
    {
        $book_category_ids = BookCategory::all();
        $book_type_ids = BookType::all();
        return view('books.edit', compact('book', 'book_category_ids', 'book_type_ids'));
    }
    public function update(Request $request, Book  $book)
    {
        $this->validate($request, ['book_title' => 'required',  'book_category_id' => 'required', 'book_type_id' => 'required', 'qty'=>'required','shelf' => 'required', 'author_name' => 'required']);
        $book->book_title = $request->book_title;
        $book->book_category_id = $request->book_category_id;
        $book->book_type_id = $request->book_type_id;
        $book->shelf = $request->shelf;
        $book->author_name = $request->author_name;
        $book->qty = $request->qty;
        $book->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('books.edit', $book->id);
    }
    public function destroy(Book $book)
    {
        $book->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('books.index');
    }
}
