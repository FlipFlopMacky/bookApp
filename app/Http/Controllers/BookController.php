<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
  public function index ()
  {
      $books = Book::all();
      return view('books', ['books' => $books]);
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
          return redirect('/')
              ->withInput()
              ->withErrors($validator);
    }

    $book = new Book;
    $book->title = $request->name;
    $book->save();

    return redirect('/');
  }
  public function destroy(Book $book)
    {
      $book->delete();

      return redirect('/');
    }
}
