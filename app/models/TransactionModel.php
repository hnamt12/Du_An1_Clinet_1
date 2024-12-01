<?php 
namespace   App\Models;

class TransactionModel extends BaseModel{
    protected $table = 'transactions';
    public function createTransaction($data)
    {
        return $this->insert($data);
    }
}