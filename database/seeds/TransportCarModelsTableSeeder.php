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

        foreach($models as $model){
            $transport_car_model = new TransportCarModel;
            $transport_car_model->id = $model->transport_car_models->id;
            $transport_car_model->title = $model->transport_car_models->title;
            $transport_car_model->transport_car_mark_id = $model->transport_car_models->mark_id;
            $transport_car_model->save();
        }
    }
}
