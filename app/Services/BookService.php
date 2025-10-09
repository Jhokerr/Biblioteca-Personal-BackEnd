<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * Obtiene todos los libros.
     *
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return Book::all();
    }

    /**
     * Crea un nuevo libro.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    /**
     * Encuentra un libro por su ID.
     *
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return Book::find($id);
    }

    /**
     * Actualiza un libro existente.
     *
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);
        return $book;
    }

    /**
     * Elimina un libro.
     *
     * @param Book $book
     * @return void
     */
    public function deleteBook(Book $book): void
    {
        $book->delete();
    }
}