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

}
