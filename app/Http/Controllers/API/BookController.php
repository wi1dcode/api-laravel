<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::paginate(2));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:100',
            'summary' => 'required|string|min:10|max:500',
            'isbn' => 'required|string|size:13|unique:books,isbn',
        ]);

        $book = Book::create($data);

        return (new BookResource($book))->response()->setStatusCode(201);
    }

    public function show(Book $book)
    {
        $book = Cache::remember('book-' . $book->id, 60 * 60, function () use ($book) {
            return $book;
        });

        return new BookResource($book);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:100',
            'summary' => 'required|string|min:10|max:500',
            'isbn' => 'required|string|size:13|unique:books,isbn,' . $book->id,
        ]);

        $book->update($data);

        Cache::forget('book-' . $book->id);

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        Cache::forget('book-' . $book->id);

        $book->delete();

        return response()->json(null, 204);
    }
}