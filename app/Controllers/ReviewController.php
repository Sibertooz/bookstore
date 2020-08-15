<?php namespace App\Controllers;

use App\Models\RegularCustomerModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;

class ReviewController extends Controller {
    function index() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        helper(['form', 'url']);

        echo view('review/review');
    }

    public function addReview() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        helper(['form', 'url']);

        $bookId = $this->request->getVar('book_id');
        $userId = $this->request->getVar('user_id');
        $mark = $this->request->getVar('rating');
        $title = $this->request->getVar('review_title');
        $text = $this->request->getVar('review_text');
        $userName = $this->request->getVar('user_name');

        $reviewModel = new ReviewModel();

        if($this->isNull($mark, $title, $text)) {
            echo "<script>alert('Не все поля заполнены');</script>";
            echo "<script>window.location = 'http://bookstore/book_info/$bookId';</script>";
            return;
        }

        $reviewModel->addReviewByBookIdAndCustomerId($bookId, $userId, $title, $text, $mark, $userName);
        echo "<script>alert('Ваш отзыв был успешно добавлен');</script>";
        echo "<script>location.href = 'http://bookstore/book_info/$bookId';</script>";
    }

    public function checkUserData() {
        helper(['form', 'url']);

        $email = $this->request->getVar('review_email');
        $password = $this->request->getVar('review_password');
        $bookId = $this->request->getVar('book_id');
        $bookName = $this->request->getVar('book_name');
        $bookAuthor = $this->request->getVar('book_author');

        $customerModel = new RegularCustomerModel();

        if ($this->isNull($email, $password)) {
            echo "<script>alert('Не все поля заполнены')</script>";
            echo "<script>window.location = 'http://bookstore/book_info/$bookId';</script>";
            return;
        }

        if ($customerModel->getCountCustomersByEmail($email) == 0) {
            echo "<script>alert('Вы ввели неверный e-mail')</script>";
            echo "<script>window.location = 'http://bookstore/book_info/$bookId';</script>";
            return;
        }

        $encryptPassword = null;
        $data['user_id'] = null;
        $data['user_name'] = null;
        $regularCustomer['user'] = $customerModel->getRegularCustomerByEmail($email);
        foreach($regularCustomer['user'] as $user) {
            $data['user_id'] = $user['customer_id'];
            $data['user_name'] = $user['full_name'];
            $encryptPassword = $user['password'];
        }

        $data['book_id'] = $bookId;
        $data['book_name'] = $bookName;
        $data['book_author'] = $bookAuthor;

        if (password_verify($password, $encryptPassword)) {
            echo view('review/review', $data);
        } else {
            echo "<script>alert('Вы ввели неправильный пароль');</script>";
            echo "<script>window.location = 'http://bookstore/book_info/$bookId';</script>";
            return;
        }
    }

    function isNull(...$params) {
        foreach ($params as $param) if ($param == null) return true;
        return false;
    }

}