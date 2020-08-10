<?php

use Illuminate\Database\Seeder;

use App\Models\Transport\TransportCarMark;

class TransportCarMarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $getMarks = file_get_contents(storage_path('app/json/marks.json'));
        $marks = json_decode($getMarks);

        foreach($marks as $mark){
            $transport_car_mark = new TransportCarMark;
            $transport_car_mark->title = $mark->transport_car_marks->title;

            if ($mark->published) {
                $transport_car_mark->logo = $mark->transport_car_marks->logo_src;
                $transport_car_mark->published = $mark->transport_car_marks->popular;
            }

            $transport_car_mark->save();
        }
    }
}
