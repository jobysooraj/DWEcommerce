<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $vendorRole = Role::firstOrCreate(['name' => 'vendor']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        dd($adminRole);
       $admin= User::create([
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => bcrypt('Admin@DW'),
            
        ]);
        $admin->assignRole($adminRole);
        $vendor=User::create([
            'name' => 'Vendor',
            'email' => 'vendor@mailinator.com',
            'password' => bcrypt('Vendor@DW'),
            
        ]);
         $vendor->assignRole($vendorRole);
        $customer1=User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@mailinator.com',
            'password' => bcrypt('Customer1@DW'),
            
        ]);
        $customer1->assignRole($customerRole);
        $customer2=User::create([
            'name' => 'Customer 2',
            'email' => 'customer2@mailinator.com',
            'password' => bcrypt('Customer2@DW'),
            
        ]);
        $customer2->assignRole($customerRole);
    }
}
