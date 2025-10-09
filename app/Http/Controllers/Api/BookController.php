<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
     // Mostrar todos los libros
    public function index(Request $request)
{
    $search = $request->input('search');

    if ($search) {
        $books = Book::where('title', 'LIKE', "%{$search}%")
                     ->orWhere('author', 'LIKE', "%{$search}%")
                     ->paginate(9); // Pagina los resultados de la búsqueda
    } else {
        $books = Book::paginate(9); // Pagina todos los libros, 10 por página
    }

    return response()->json($books);
}

    // Guardar un nuevo libro
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

        $book = Book::create($validatedData);
        return response()->json($book, 201); // 201: Creado
    }

    // Mostrar un libro específico
    public function show(Book $book)
    {
        return response()->json($book);
    }

    // Actualizar un libro
    public function update(Request $request, Book $book)
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

        $book->update($validatedData);
        return response()->json($book);
    }

    // Eliminar un libro
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204); // 204: Sin Contenido
    }

    
}


