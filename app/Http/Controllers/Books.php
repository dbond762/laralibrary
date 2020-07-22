<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

class Books extends Controller
{
    public function index() {
        return Book::all();
    }

    public function authors() {
        return Author::all();
    }

    public function bookAuthors($author_id) {
        return Book::where('author_id', $author_id)->get();
    }
}
