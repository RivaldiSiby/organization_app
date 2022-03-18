<?php

namespace App\Database\Seeds;

use App\Models\AdminModel;
use CodeIgniter\Database\Seeder;

class Adminseed extends Seeder
{
    public function run()
    {
        // data admin
        $data = [
            'nama' => 'adminOAv1',
            'password' => password_hash('organizationappdemo2022', PASSWORD_BCRYPT),
            'pin' => password_hash('demo2022', PASSWORD_BCRYPT),
        ];
        // insert data admin
        $admin = new AdminModel();
        $admin->save($data);
    }
}
