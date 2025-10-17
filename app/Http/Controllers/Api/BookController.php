<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Mostrar solo los libros del usuario autenticado
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = $request->user(); // Obtener usuario autenticado

        if ($search) {
            $books = Book::where('user_id', $user->id)
                         ->where('title', 'LIKE', "%{$search}%")
                         ->orWhere('author', 'LIKE', "%{$search}%")
                         ->paginate(9);
        } else {
            $books = Book::where('user_id', $user->id)->paginate(9);
        }

        return response()->json($books);
    }

    // Guardar un nuevo libro (asociado al usuario autenticado)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'genre' => 'nullable|string',      
            'published_year' => 'nullable|integer', 
            'pages' => 'nullable|integer',       
            'cover_url' => 'nullable|url',       
            'reading_status' => 'nullable|string', 
        ]);

        // Agregar el usuario autenticado
        $validatedData['user_id'] = $request->user()->id;

        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }

    // Mostrar un libro específico (solo si pertenece al usuario)
    public function show(Book $book, Request $request)
    {
        if ($book->user_id !== $request->user()->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        return response()->json($book);
    }

    // Actualizar un libro (solo si pertenece al usuario)
    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== $request->user()->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'genre' => 'nullable|string',       
            'published_year' => 'nullable|integer', 
            'pages' => 'nullable|integer',       
            'cover_url' => 'nullable|url',      
            'reading_status' => 'nullable|string', 
        ]);

        $book->update($validatedData);
        return response()->json($book);
    }

    // Eliminar un libro (solo si pertenece al usuario)
    public function destroy(Request $request, Book $book)
    {
        if ($book->user_id !== $request->user()->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $book->delete();
        return response()->json(null, 204);
    }
}