<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => Role::SUPER_ADMIN,
                'slug' => 'super-admin',
                'description' => 'Complete authority over Maison settings, roles, financial records, and operations.',
            ],
            [
                'name' => Role::ADMIN,
                'slug' => 'admin',
                'description' => 'Maison administrator with catalog, inventory, order, and customer oversight.',
            ],
            [
                'name' => Role::MANAGER,
                'slug' => 'manager',
                'description' => 'Store manager controlling inventory replenishment, promotions, and customer service.',
            ],
            [
                'name' => Role::STAFF,
                'slug' => 'staff',
                'description' => 'Concierge and boutique staff managing order fulfillment and customer inquiries.',
            ],
            [
                'name' => Role::CUSTOMER,
                'slug' => 'customer',
                'description' => 'Distinguished private client of Modern Jewellery House.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
