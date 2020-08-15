<?php namespace App\Controllers;
use App\Models\BookModel;
use App\Models\GenreModel;
use App\Models\ShopCartModel;
use CodeIgniter\Controller;
class Home extends Controller {

	public function index()
	{
        $session = session();
        $session->start();
        $ipAddress = $_SERVER['REMOTE_ADDR'];

	    helper(['form', 'url']);

	    $genreModel = new GenreModel();
        $bookModel = new BookModel();
        $cartModel = new ShopCartModel();

        $data['books1'] = $bookModel->getAllBooksByGenreId(1);
        $data['books2'] = $bookModel->getAllBooksByGenreId(2);
        $data['genres'] = $genreModel->getGenres();
        $data['booksCount'] = $cartModel->getCountProductsFromCart($ipAddress);
        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        echo view('index', $data);
	}

	public function updateBooksCountInCart() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        helper(['form', 'url']);

        $cartModel = new ShopCartModel();

        $booksCount = $this->request->getPost('bkCount');
        $booksCountId = $this->request->getPost('bkCountId');

        $cartModel->updateCart($ipAddress, $booksCountId, $booksCount);
    }

    public function deleteBookFromCart() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        helper(['form', 'url']);

        $cartModel = new ShopCartModel();

        $bookToDelete = $this->request->getPost('bkDelete');
        $cartModel->deleteFromCart($ipAddress, $bookToDelete);
    }

    public function sendBooksCount() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        helper(['form', 'url']);
        $cartModel = new ShopCartModel();
        $data['booksCountInCart'] = $cartModel->getCountProductsFromCart($ipAddress);
        echo json_encode($data);
    }

    public function addBookToCart() {
        $session = session();
        $session->start();
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        helper(['form', 'url']);

        $cartModel = new ShopCartModel();

        $bookId = $this->request->getPost('bookId');
        $bookName = $this->request->getPost('bookName');
        $bookAuthor = $this->request->getPost('bookAuthor');
        $bookCost = $this->request->getPost('bookCost');

        $cartModel->addToCart($sessionId, $ipAddress, $bookId, $bookName, $bookAuthor, $bookCost);
        $session->destroy();
    }
}
