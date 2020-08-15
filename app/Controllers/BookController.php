<?php


namespace App\Controllers;


use App\Models\BookModel;
use App\Models\RegularCustomerModel;
use App\Models\ReviewModel;
use App\Models\ShopCartModel;
use CodeIgniter\Controller;

$globalBookId = null;
class BookController extends Controller
{
    public function index() {
        global $globalBookId;
        $session = session();
        $session->start();
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        helper(['form', 'url']);

        $bookId = $this->request->getVar('book_id');
        $bookName = $this->request->getVar('book_name');
        $bookAuthor = $this->request->getVar('book_author');
        $bookCost = $this->request->getVar('book_cost');

        if ($globalBookId == null) $globalBookId = $bookId;

        $bookModel = new BookModel();
        $cartModel = new ShopCartModel();

        $data['bookExistInCart'] = true;

        if ($bookId != null) {
            $cartModel->addToCart($sessionId, $ipAddress, $bookId, $bookName, $bookAuthor, $bookCost);
            $session->destroy();
        }

        $data['books'] = $bookModel->getOneBookByBookId($globalBookId);

        $data['booksCount'] = $cartModel->getCountProductsFromCart($ipAddress);
        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        echo view('book_info', $data);
    }

    public function showBookInfo($bookId = null) {
        helper(['form', 'url']);
        global $globalBookId;
        $globalBookId = $bookId;

        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $model = new BookModel();
        $data['books'] = $model->getOneBookByBookId($bookId);

        if (empty($data['books']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Не могу найти книгу по URL-адресу: '. $bookId);
        }

        $cartModel = new ShopCartModel();
        $reviewModel = new ReviewModel();

        $data['booksCount'] = $cartModel->getCountProductsFromCart($ipAddress);
        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        $data['bookExistInCart'] = false;
        if ($cartModel->productIsInCart($ipAddress, $globalBookId) == true) $data['bookExistInCart'] = true;

        $data['reviews'] = $reviewModel->getAllReviewsByBookId($bookId);

        echo view('book_info', $data);
    }

}