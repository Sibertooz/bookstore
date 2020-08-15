<?php

namespace App\Controllers;
use App\Models\OrderBookModel;
use App\Models\OrderModel;
use App\Models\RegularCustomerModel;
use App\Models\ShopCartModel;
use CodeIgniter\Controller;

class OrderController extends Controller {

    function index() {
        helper(['form', 'url']);

        $session = session();
        $session->start();
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $cartModel = new ShopCartModel();

        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);

        $totalSum = 0;
        foreach ($data['booksInCart'] as $book) {
            $sum = $book['product_cost']*$book['product_count'];
            $totalSum += $sum;
        }
        $data['totalSum'] = $totalSum;

        $title = session_id();
        $data['file_name'] = $title;

        $fp = fopen("files/$title.txt", "w");
        $text1= "Содержимое Вашей корзины: \n ";
        fwrite($fp, $text1);
        foreach ($data['booksInCart'] as $datum) {
            $text2 = "\n|    Название книги: 			|	".'"'.$datum['product_name'].'"';
            fwrite($fp, $text2);
            $text3 = "\n|    Автор: 				|	".$datum['product_author'];
            fwrite($fp, $text3);
            $text4 = "\n|    Стоимость: 			|	".$datum['product_cost'].' грн';
            fwrite($fp, $text4);
            $text5 = "\n|    Количество в заказе: 		|	".$datum['product_count'].' шт.';
            fwrite($fp, $text5);
            $text6 = "\n|    Общая стоимость товара в заказе:	|	".$datum['product_count']*$datum['product_cost'].' грн';
            fwrite($fp, $text6);
            $text7 = "\n--------------------------------------------------------------------------------------";
            fwrite($fp, $text7);
        }
        $text8 = "\n\nОбщая сумма заказа составляет ".$data['totalSum'].' грн';
        fwrite($fp, $text8);
        fclose($fp);

        $session->destroy();

        echo view('order/order', $data);
    }

    public function addOrder() {
        helper(['form', 'url']);

        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $fullName = $this->request->getVar('order_full_name');
        $phone = $this->request->getVar('order_phone');
        $address = $this->request->getVar('order_address');
        $email = $this->request->getVar('order_email');

        $url = base_url();

        if ($this->isNull($fullName, $phone, $address, $email)) {
            echo "<script>alert('Не все поля заполнены')</script>";
            echo "<script>window.location = '$url/order/';</script>";
            return;
        }

        $cartModel = new ShopCartModel();
        $orderModel = new OrderModel();
        $orderBookModel = new OrderBookModel();

        $orderId = $orderModel->addOrder($fullName, $address, $phone, $email);

        $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);
        foreach($data['booksInCart'] as $book) {
            $orderBookModel->addToOrderBook($book['product_id'], $orderId);
        }

        $cartModel->deleteCart($ipAddress);

        echo "<script>alert('Ваш заказ успешно сформирован. Наш менеджер в скором времени свяжется с вами.');</script>";
        echo view('order/success');
    }

    public function addOrderFromCustomer() {
        helper(['form', 'url']);
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $regularEmail = $this->request->getVar('regular_email');
        $regularPassword = $this->request->getVar('regular_password');

        $customerModel = new RegularCustomerModel();

        $orderModel = new OrderModel();
        $orderBookModel = new OrderBookModel();
        $cartModel = new ShopCartModel();

        if ($this->isNull($regularEmail, $regularPassword)) {
            echo "<script>alert('Не все поля заполнены')</script>";
            echo "<script>window.location = 'http://bookstore/order/';</script>";
            return;
        }

        if ($customerModel->getCountCustomersByEmail($regularEmail) == 0) {
            echo "<script>alert('Вы ввели неверный e-mail')</script>";
            echo "<script>window.location = 'http://bookstore/order/';</script>";
            return;
        }

        $fullName = null;
        $address = null;
        $phone = null;
        $customerId = null;
        $encryptPassword = null;

        $regularCustomer['user'] = $customerModel->getRegularCustomerByEmail($regularEmail);
        foreach($regularCustomer['user'] as $user) {
            $fullName = $user['full_name'];
            $address = $user['address'];
            $phone = $user['phone'];
            $customerId = $user['customer_id'];
            $encryptPassword = $user['password'];
        }

        if (password_verify($regularPassword, $encryptPassword)) {
            $orderId = $orderModel->addRegularCustomerOrder($fullName, $address, $phone, $regularEmail, $customerId);
            $customerModel->changeActiveOrdersByCustomerEmail($regularEmail);

            $data['booksInCart'] = $cartModel->getAllProductsFromCart($ipAddress);
            foreach($data['booksInCart'] as $book) {
                $orderBookModel->addToOrderBook($book['product_id'], $orderId);
            }

            $cartModel->deleteCart($ipAddress);
            echo view('order/success');
        } else {
            echo "<script>alert('Вы ввели неправильный пароль');</script>";
            echo "<script>window.location = 'http://bookstore/order/';</script>";
            return;
        }
    }

    function isNull(...$params) {
        foreach ($params as $param) if ($param == null) return true;
        return false;
    }

}