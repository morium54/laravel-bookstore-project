<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show all books with pagination
    public function index()
    {
        $books = Book::paginate(10); // Show 10 books per page
        return view('books.index', compact('books'));
    }

    // Show form to create a new book
    public function create()
    {
        return view('books.create');
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Show a single book
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Show form to edit a book
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
