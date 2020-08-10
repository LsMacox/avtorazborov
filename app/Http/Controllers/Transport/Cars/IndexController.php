<?php

namespace App\Http\Controllers\Transport\Cars;

use Illuminate\Http\Request;
use App\Http\Controllers\Transport\Cars\BaseController;
use App\Repositories\Transport\Cars\MarksRepository as TransportCarMarksRepository;

class IndexController extends BaseController
{

    protected $transportCarMarksRepository;

    public function __construct()
    {
        parent::__construct();
        $this->transportCarMarksRepository = app(TransportCarMarksRepository::class);
    }

    public function getAllMarks () {
        $marks = $this->transportCarMarksRepository->getAll();
        return response()->json($marks);
    }

    public function getMarkModels ($mark_name) {

        $models = $this->transportCarMarksRepository->getMarkModels($mark_name);

        return response()->json($models);

    }

    public function getAllModels () {
        $marks = $this->transportCarMarksRepository->getAll();
        return response()->json($marks);
    }

}
