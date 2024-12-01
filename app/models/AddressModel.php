<?php 
namespace App\Models;
class AddressModel extends BaseModel{
    protected $table = 'addresses';

    public function getAddressesByUser($userId)
    {
        return $this->select('*', 'user_id = :user_id', ['user_id' => $userId]);
    }
    public function insertAddress($data)
    {
        return $this->insert($data);
    }
}