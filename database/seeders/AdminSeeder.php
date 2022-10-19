<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{
    Role, Permission
};

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'view admin page']);

        $role = Role::create(['name' => 'admin']);

        $role->givePermissionTo(['view admin page']);
    }
}
