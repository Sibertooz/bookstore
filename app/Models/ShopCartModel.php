<?php namespace App\Models;

use CodeIgniter\Model;

class ShopCartModel extends Model {
    protected $table = 'shop_cart';

    public function addToCart($sessionId, $ipAddress, $productId, $productName,
                              $productAuthor, $productCost) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        if($this->productIsInCart($ipAddress, $productId) == true) {
            $this->updateCart($ipAddress, $productId, $this->getProductCountByProductId($ipAddress, $productId) + 1);
        } else {
            $builder->set('session_id', $sessionId);
            $builder->set('ip_address', $ipAddress);
            $builder->set('product_id', $productId);
            $builder->set('product_name', $productName);
            $builder->set('product_author', $productAuthor);
            $builder->set('product_cost', $productCost);
            $builder->set('product_count', 1);
            $builder->insert();
        }
    }

    public function updateCart($ipAddress, $productId, $productCount) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        $builder->set('product_count', $productCount, FALSE)->where([
            'ip_address' => $ipAddress,
            'product_id' => $productId
        ])->update();
    }

    public function deleteFromCart($ipAddress, $productId) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        $builder->delete([
            'ip_address' => $ipAddress,
            'product_id' => $productId
            ]);
    }

    public function deleteCart($ipAddress) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        $builder->delete([
            'ip_address' => $ipAddress
            ]);
    }

    public function getAllProductsFromCart($ipAddress) {
        return $this->where('ip_address', $ipAddress)->findAll();
    }

    public function getCountProductsFromCart($ipAddress) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        return $builder->where('ip_address', $ipAddress)->countAllResults();
    }

    public function productIsInCart($ipAddress, $productId) {
        $db = \Config\Database::connect();
        $builder = $db->table('shop_cart');

        $builder->where([
            'ip_address' => $ipAddress,
            'product_id' => $productId
        ]);

        if ($builder->countAllResults() > 0) return true;
        else return false;
    }

    public function getProductCountByProductId($ipAddress, $productId) {
        $query = $this->select('product_count')->where([
            'ip_address' => $ipAddress,
            'product_id' => $productId
        ])->find();

        return (int) $query;
    }

}