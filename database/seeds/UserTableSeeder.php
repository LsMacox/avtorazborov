<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSettings\ShopSetting;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function generatePIN($digits = 4){
            $i = 0; //counter
            $pin = ""; //our default pin is blank.
            while($i < $digits){
                //generate a random number between 0 and 9.
                $pin .= mt_rand(0, 9);
                $i++;
            }
            return $pin;
        }

        $role_super_admin = Role::where("name", "super_admin")->first();
        $role_admin = Role::where("name", "admin")->first();
        $role_shop = Role::where("name", "shop")->first();
        $role_login = Role::where("name", "user")->first();

        $admin = new User();
        $admin->login = "7999999999";
        $admin->password = bcrypt("prokadastr");
        $admin->save();
        $admin->roles()->attach($role_admin);

        $admin = new User();
        $admin->login = "78888888888";
        $admin->password = bcrypt("satana666");
        $admin->save();
        $admin->roles()->attach($role_admin);


        $user = new User();
        $user->login = "70000000000";
        $user->password = bcrypt("secret");
        $user->save();
        $user->roles()->attach($role_login);

        $shop = new User();
        $shop->login = "71111111111";
        $shop->password = bcrypt("secret");
        $shop->save();
        $shop->roles()->attach($role_shop);

        $user_settings = new ShopSetting();
        $user_settings->user_id = $shop->id;
        $user_settings->save();
        
    }
}
