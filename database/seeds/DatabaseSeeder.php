<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        # Convert TransportDb in json
        # $this->call(CarsConvertToJson::class);

        # Convert TariffsDb in json
        # $this->call(TariffDbConvertToJson::class);

        # Convert PushNotificationToken in json
        # $this->call(PushNotificationTokensDbToJson::class);


        # TransportCarMarks seeder
//        $this->call(TransportCarMarksTableSeeder::class);
        # TransportCarModels seeder
//        $this->call(TransportCarModelsTableSeeder::class);
        # Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        # Push notification seeder
        $this->call(PushNotificationTokensSeeder::class);
        # Tariff seeder
        $this->call(TariffSeeder::class);


        # User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);
    }
}
