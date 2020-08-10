<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = new Role();
        $role_super_admin->name = "super_admin";
        $role_super_admin->description = "Super-administration";
        $role_super_admin->save();

        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "Administration";
        $role_admin->save();

        $role_avtorazborka = new Role();
        $role_avtorazborka->name = "shop";
        $role_avtorazborka->description = "Shop";
        $role_avtorazborka->save();

        $role_login = new Role();
        $role_login->name = "user";
        $role_login->description = "User";
        $role_login->save();
    }
}
