<?php namespace App\Controllers;

use App\Models\BookModel;
use App\Models\ShopCartModel;
use CodeIgniter\Controller;

class SearchController extends Controller {
    function index() {
        helper(['form', 'url']);
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $cartModel = new ShopCartModel();
        $data['booksCount'] = $cartModel->getCountProductsFromCart($ipAddress);
        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        echo view('search/search', $data);
    }

    public function searchBooks() {
        helper(['form', 'url']);
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $bookData = $this->request->getVar('book_data');

        $bookModel = new BookModel();
        $data['books'] = $bookModel->getAllBooksByBookNameOrAuthor($bookData);

        $cartModel = new ShopCartModel();
        $data['booksCount'] = $cartModel->getCountProductsFromCart($ipAddress);
        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        echo view('search/search', $data);
    }
}