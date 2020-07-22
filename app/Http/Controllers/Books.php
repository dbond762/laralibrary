<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function my() {
        $user_id = Auth::user()->id;
        return Book::where('created_by', $user_id)->get();
    }

    public function create() {
        $this->validate(request(), [
            'name' => 'required',
            'str_num' => 'required|integer|min:1',
            'annotation' => 'nullable',
            'img' => 'required',
            'author_id' => 'required|integer',
        ]);

        $user_id = Auth::user()->id;

        $book = Book::create(array_merge(request([
            'name',
            'str_num',
            'annotation',
            'img',
            'author_id',
        ]), [
            'created_by' => $user_id,
        ]));

        return response()->json(['id' => $book->id]);
    }

    public function edit($book_id) {
        $validated_data = request()->validate([
            'name' => 'nullable',
            'str_num' => 'nullable|integer|min:1',
            'annotation' => 'nullable',
            'img' => 'nullable',
            'author_id' => 'nullable|integer',
        ]);

        Book::where('id', $book_id)->update($validated_data);

        return response()->json(['message' => "Book {$book_id} successfully updated"]);
    }

    public function delete($book_id) {
        $book = Book::find($book_id);
        $book->delete();

        return response()->json(['message' => "Book {$book->id} successfully deleted"]);
    }
}
