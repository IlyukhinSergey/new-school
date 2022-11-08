<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    function index()
    {
        $books = Book::all();
        return view('books.list', ['books' => $books]);
    }

    function edit($id)
    {
        $book = Book::query()->find($id);
        return view('books.edit', ['book' => $book]);
    }

    function save(Request $request)
    {
        $book = Book::query()->find($request->id);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'numeric',

        ]);

        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        return redirect()->route('books');
    }

    function delete(Request $request)
    {
        Book::destroy($request->id);
        return redirect()->route('books');
    }

}
