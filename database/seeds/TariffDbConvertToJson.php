<?php

use Illuminate\Database\Seeder;

use App\Models\Tariff;

class TariffDbConvertToJson extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tariff = Tariff::all();

        $tariffs = json_encode($tariff);

        Storage::put('json/tariff.json', $tariffs);

    }
}
