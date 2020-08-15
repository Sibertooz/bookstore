<?php namespace App\Models;


use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    public function addOrder($fullName, $address, $phone, $email) {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');

        $builder->set('full_name', $fullName);
        $builder->set('address', $address);
        $builder->set('phone', $phone);
        $builder->set('email', $email);
        $builder->insert();

        return $this->db->insertID();
    }

    public function addRegularCustomerOrder($fullName, $address, $phone, $email, $customerId) {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');

        $builder->set('full_name', $fullName);
        $builder->set('address', $address);
        $builder->set('phone', $phone);
        $builder->set('email', $email);
        $builder->set('customer_id', $customerId);
        $builder->insert();

        return $this->db->insertID();
    }
}