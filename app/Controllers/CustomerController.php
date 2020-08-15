<?php namespace App\Controllers;

use App\Models\RegularCustomerModel;
use CodeIgniter\Controller;

class CustomerController extends Controller {
    function index() {
        echo view('customer/customer');
    }

    public function addRegularCustomer() {
        helper(['form', 'url']);

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $phone = $this->request->getVar('phone');
        $fullName = $this->request->getVar('full_name');
        $address = $this->request->getVar('address');

        if ($this->isNull($email, $password, $phone, $fullName, $address)) {
            echo "<script>alert('Не все поля заполнены')</script>";
            echo "<script>window.location = 'http://bookstore/customer/';</script>";
            return;
        }

        $encrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $customerModel = new RegularCustomerModel();

        if ($customerModel->getCountCustomersByEmail($email) > 0) {
            echo "<script>alert('Пользователь с таким e-mail уже зарегистрирован');</script>";
            echo "<script>window.location = 'http://bookstore/customer/';</script>";
            return;
        }

        $customerModel->addRegularCustomer($fullName, $address, $phone, $email, $encrypt_password);

        echo "<script>alert('Поздравляем! Вы стали постоянным клиентом магазина BookStore!');</script>";
        echo "<script>window.close();</script>";
    }

    function isNull(...$params) {
        foreach ($params as $param) if ($param == null) return true;
        return false;
    }
}