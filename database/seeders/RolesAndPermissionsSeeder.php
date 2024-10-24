<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            // Vendor Permissions
            'create-vendors',
            'view-vendors',
            'edit-vendors',
            'delete-vendors',

            // Product Permissions
            'create-any-product',
            'view-any-product',
            'edit-any-product',
            'delete-any-product',

            // Stock Permissions
            'view-stock-any-product',
            'add-stock-for-any-product',
            'edit-stock-for-any-product',
            'delete-stock-for-any-product',

            // Customer Permissions
            'create-customer',
            'view-customer',
            'edit-customer',
            'delete-customer',

            // Order Permissions
            'view-any-order',
            'edit-any-order',
            'delete-any-order',
            'manage-order-status',

            // Vendor Permissions
            'create-own-product',
            'view-own-product',
            'edit-own-product',
            'delete-own-product',

            'view-stock-for-own-product',
            'add-stock-for-own-product',
            'edit-stock-for-own-product',
            'delete-stock-for-own-product',  
            'update-own-order-status',

            // General Customer Permissions
            'view-products',
            'view-product-details',
            'add-to-cart',
            'view-cart',
            'update-cart',
            'remove-from-cart',
            'place-order',
            'view-own-orders',
            'cancel-own-order',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
           
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $vendorRole = Role::firstOrCreate(['name' => 'vendor']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        $adminRole->givePermissionTo([
            'create-vendors',
            'view-vendors',
            'edit-vendors',
            'delete-vendors',
            'create-any-product',
            'view-any-product',
            'edit-any-product',
            'delete-any-product',
            'view-stock-any-product',
            'add-stock-for-any-product',
            'edit-stock-for-any-product',
            'delete-stock-for-any-product',
            'create-customer',
            'view-customer',
            'edit-customer',
            'delete-customer',
            'view-any-order',
            'edit-any-order',
            'delete-any-order',
            'manage-order-status',
        ]);


        $vendorRole->givePermissionTo([
            'create-own-product',
            'view-own-product',
            'edit-own-product',
            'delete-own-product',
            'view-stock-for-own-product',
            'add-stock-for-own-product',
            'edit-stock-for-own-product',
            'delete-stock-for-own-product',
            'view-own-orders',
            'update-own-order-status',
        ]);

       

        $customerRole->givePermissionTo([
            'view-products',
            'view-product-details',
            'add-to-cart',
            'view-cart',
            'update-cart',
            'remove-from-cart',
            'place-order',
            'view-own-orders',
            'cancel-own-order',
        ]);

    }
}
