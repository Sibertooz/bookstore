<?php namespace App\Models;


use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';

    public function addReviewByBookIdAndCustomerId($bookId, $customerId, $reviewTitle, $reviewText, $mark, $customerName) {
        $db = \Config\Database::connect();
        $builder = $db->table('reviews');

        $builder->set('review_title', $reviewTitle);
        $builder->set('review_text', $reviewText);
        $builder->set('mark', $mark);
        $builder->set('book_id', $bookId);
        $builder->set('customer_id', $customerId);
        $builder->set('customer_name', $customerName);
        $builder->insert();
    }

    public function getAllReviewsByBookId($bookId) {
        return $this->where('book_id', $bookId)->findAll();
    }
}