<?php

use App\Models\Transport\TransportCarModel;
use Illuminate\Database\Seeder;

class TransportCarModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getModels = file_get_contents(storage_path('app/json/models.json'));
        $models = json_decode($getModels);

        foreach($models->transport_car_models as $model){
            $transport_car_model = new TransportCarModel;
            $transport_car_model->id = $model->id;
            $transport_car_model->title = $model->title;
            $transport_car_model->transport_car_mark_id = $model->mark_id;
            $transport_car_model->save();
        }
    }
}
