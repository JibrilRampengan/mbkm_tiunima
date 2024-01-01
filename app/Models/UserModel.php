<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'password', 'nim', 'tipe_pengguna'];

    public function isUnique(array $data)
    {
        $builder = $this->where($data)->get();

        return ($builder->getRow() === null);
    }
}
