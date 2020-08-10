<?php

use App\Models\Transport\TransportCarMark;
use App\Models\Transport\TransportCarModel;
use Illuminate\Database\Seeder;

class CarsConvertToJson extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getMarks = \DB::table('car_marks')->get();
        $getModels = \DB::table('car_models')->get();

        $marks = [];
        $models = [];
        $test = [];

        foreach ($getMarks as $mark)
        {
            $marks['id'] = $mark->id;
            $marks['title'] = $mark->title;
            $marks['logo'] = $mark->logo_src;
            $marks['published'] = $mark->popular;
        }

        foreach ($getModels as $model)
        {
            $models['id'] = $model->id;
            $models['title'] = $model->title;
            $models['transport_car_mark_id'] = $model->mark_id;
        }

        $marks = json_encode($marks);
        $models = json_encode($models);

        Storage::disk('public')->put('json/marks.json', $marks);
        Storage::disk('public')->put('json/models.json', $models);
    }
}
