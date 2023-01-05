<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Master extends Seeder
{
    public function run()
    {
        //
        $this->call('Administrator');
        $this->call('Customer');
        $this->call('Material');
        $this->call('Product');
        $this->call('Supplier');
        $this->call('Transaction');
    }
}
