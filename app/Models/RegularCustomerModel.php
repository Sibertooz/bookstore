<?php namespace App\Models;


use CodeIgniter\Model;

class RegularCustomerModel extends Model
{
    protected $table = 'regular_customers';

    public function addRegularCustomer($fullName, $address, $phone, $email, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('regular_customers');

        $builder->set('full_name', $fullName);
        $builder->set('address', $address);
        $builder->set('phone', $phone);
        $builder->set('email', $email);
        $builder->set('password', $password);
        $builder->insert();
    }

    public function changeActiveOrdersByCustomerEmail($email) {
        $db = \Config\Database::connect();
        $builder = $db->table('regular_customers');

        $builder->set('has_active_orders', 1, FALSE)->where('email', $email)->update();
    }

    public function getRegularCustomerByEmail($email) {
        return $this->where('email', $email)->find();
    }

    public function getCountCustomersByEmail($email) {
        return $this->where('email', $email)->countAllResults();
    }

    public function changeAuthFieldByEmail($email, bool $auth) {
        $db = \Config\Database::connect();
        $builder = $db->table('regular_customers');

        $builder->set('auth', $auth)->where('email', $email)->update();
    }
}