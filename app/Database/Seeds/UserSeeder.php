<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'rikins',
            'password' => password_hash('rikins', PASSWORD_BCRYPT),
            'email'    => 'rikins@gmail.com',
            'full_name' => 'Riki N'
        ];

        $this->db->table('users')->insert($data);
    }
}
