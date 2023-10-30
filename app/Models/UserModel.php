<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    protected $useTimestamps = false;

    protected $validationRules      = [];
    protected $validationMessages   = [];

    public function get(string $username) : array
    {
        return $this->where('username', $username)->first() ?? [];
    }
}
