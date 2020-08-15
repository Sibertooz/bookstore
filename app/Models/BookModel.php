<?php namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';

    public function getAllBooksByGenreId($genreId) {
        return $this->where('genre_id', $genreId)->findAll();
    }

    public function getOneBookByBookId($bookId) {
        return $this->where('book_id', $bookId)->find();
    }

    public function getAllBooksByBookNameOrAuthor($bookNameOrAuthor) {
        return $this->where('book_name', $bookNameOrAuthor)->orWhere('author', $bookNameOrAuthor)->findAll();
    }

}