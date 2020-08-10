<?php

namespace App\Http\Controllers\Admin\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Location\BaseController;

// Repositories
use App\Repositories\Location\CitiesIndexRepository;
use App\Repositories\Location\RegionsIndexRepository;

class IndexController extends BaseController
{

    protected $citiesIndexRepository;
    protected $regionsIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->citiesIndexRepository = app(CitiesIndexRepository::class);
        $this->regionsIndexRepository = app(RegionsIndexRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = $this->regionsIndexRepository->getForComboPaginate(30);
        $cities = $this->citiesIndexRepository->getForComboPaginate(30);

        return view('layouts.admin.db.location.index', compact('regions','cities'));
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
    public function storeCity(Request $request)
    {
        $city = $this->citiesIndexRepository->store($request->except('_token'));

        return redirect()
                        ->route('admin.db.location.index')
                        ->with('message', 'Успешно сохранено!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRegion(Request $request)
    {
        $region = $this->regionsIndexRepository->store($request->except('_token'));

        return redirect()
            ->route('admin.db.location.index')
            ->with('message', 'Успешно сохранено!');
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
    public function destroyCity($id)
    {
        $this->citiesIndexRepository->destroy($id);

        return redirect()
            ->route('admin.db.location.index')
            ->with('message', 'Успешно удалено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRegion($id)
    {
        $this->regionsIndexRepository->destroy($id);

        return redirect()
            ->route('admin.db.location.index')
            ->with('message', 'Успешно удалено!');
    }
}
