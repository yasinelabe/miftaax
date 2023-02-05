<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCategory;
use App\Models\Rack;

class BookCategoryController extends Controller
{
    public function index()
    {
        $book_categories = BookCategory::all();
        $list = true;
        return view('book_categories.index', compact('book_categories', 'list'));
    }
    public function create()
    {
        $rack_ids = Rack::all();
        return view('book_categories.create', compact('rack_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'rack_id' => 'required',]);
        $bookcategory = new BookCategory();
        $bookcategory->fill($request->all());
        $bookcategory->save();
        return redirect()->route('book_categories.index');
    }
    public function show(BookCategory $bookcategory)
    {
        return view('book_categories.show', compact('bookcategory',));
    }
    public function edit(BookCategory $bookcategory)
    {
        $rack_ids = Rack::all();
        return view('book_categories.edit', compact('bookcategory', 'rack_ids'));
    }
    public function update(Request $request, BookCategory  $bookcategory)
    {
        $this->validate($request, ['name' => 'required', 'rack_id' => 'required',]);
        $bookcategory->name = $request->name;
        $bookcategory->rack_id = $request->rack_id;
        $bookcategory->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('book_categories.edit', $bookcategory->id);
    }
    public function destroy(BookCategory $bookcategory)
    {
        $bookcategory->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('book_categories.index');
    }
}
