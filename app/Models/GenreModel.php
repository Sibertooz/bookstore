<?php namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $table = 'genres';

    public function getGenres() {
        return $this->findAll();
    }
}