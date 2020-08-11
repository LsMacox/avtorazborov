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

        foreach($marks->transport_car_marks as $mark){
            $transport_car_mark = new TransportCarMark;
            $transport_car_mark->title = $mark->title;

            if ($mark->popular) {
                $transport_car_mark->logo = $mark->logo_src;
                $transport_car_mark->published = $mark->popular;
            }

            $transport_car_mark->save();
        }
    }
}
