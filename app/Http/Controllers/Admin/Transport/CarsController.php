<?php

namespace App\Http\Controllers\Admin\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Transport\BaseController;

// Repositories
use App\Repositories\Transport\Cars\MarksRepository as TransportCarsMarksRepository;
use App\Repositories\Transport\Cars\ModelsRepository as TransportCarsModelsRepository;

// Requests
use App\Http\Requests\Admin\Db\CarMarksRequest;
use App\Http\Requests\Admin\Db\CarModelsRequest;

class CarsController extends BaseController
{

    protected $transportCarsMarkRepository;
    protected $transportCarsModelsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->transportCarsMarkRepository = app(TransportCarsMarksRepository::class);
        $this->transportCarsModelsRepository = app(TransportCarsModelsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = $this->transportCarsMarkRepository->getForComboPaginate(30);
        $models = $this->transportCarsModelsRepository->getForComboPaginate(30);

        return view('layouts.admin.db.cars.index', compact('marks', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMarks(CarMarksRequest $request)
    {
        $this->transportCarsMarkRepository->create($request->all());

        return redirect()
                        ->route('admin.db.cars.index')
                        ->with('success', 'Сохранено');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeModels(CarModelsRequest $request)
    {
        $this->transportCarsModelsRepository->create($request->all());

        return redirect()
                        ->route('admin.db.cars.index')
                        ->with('success', 'Сохранено');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMarks($id)
    {
        $mark = $this->transportCarsMarkRepository->getById($id);
        $mark->delete();
        return redirect()
            ->route('admin.db.cars.index')
            ->with('success', 'Успешно удалено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyModels($id)
    {
        $model = $this->transportCarsModelsRepository->getById($id);
        $model->delete();
        return redirect()
            ->route('admin.db.cars.index')
            ->with('success', 'Успешно удалено!');
    }
}
