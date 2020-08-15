<?php namespace App\Models;

use CodeIgniter\Model;

class OrderBookModel extends Model
{
    public function addToOrderBook($bookId, $orderId) {
        $db = \Config\Database::connect();
        $builder = $db->table('order_book');

        $builder->set('book_id', $bookId);
        $builder->set('order_id', $orderId);
        $builder->insert();
    }
}