<?php

use Illuminate\Database\Seeder;

use App\Models\Tariff;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getTariff = file_get_contents(storage_path('app/json/tariff.json'));
        $tariffs = json_decode($getTariff);

        foreach($tariffs as $tariff){
            $tariffDb = new Tariff;
            $tariffDb->title = $tariff->title;
            $tariffDb->description = $tariff->description;
            $tariffDb->prices = $tariff->prices;
            $tariffDb->limit_mark = $tariff->limit_mark;
            $tariffDb->created_at = $tariff->created_at;
            $tariffDb->updated_at = $tariff->updated_at;
            $tariffDb->save();
        }
    }
}
