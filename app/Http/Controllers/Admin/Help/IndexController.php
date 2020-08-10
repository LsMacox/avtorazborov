<?php

namespace App\Http\Controllers\Admin\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Help\BaseController;

// Repositories
use App\Repositories\Admin\Help\HelpIndexRepository;

// Requests
use App\Http\Requests\Admin\Help\UpdateRequest;
use App\Http\Requests\Admin\Help\StoreRequest;

class IndexController extends BaseController
{

    protected $helpIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->helpIndexRepository = app(HelpIndexRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helps = $this->helpIndexRepository->getAll();

        return view('layouts.admin.help.index', compact('helps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = $this->helpIndexRepository->getRoutes();

        return view('layouts.admin.help.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $help = $this->helpIndexRepository->create($request->except('_token'));
        return redirect()->route('admin.help.index')->with(['message' => 'Подсказка к странице успешно создана']);
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
        $routes = $this->helpIndexRepository->getRoutes();
        $help = $this->helpIndexRepository->getById($id);
        return view('layouts.admin.help.edit', ['help' => $help, 'routes' => $routes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $help = $this->helpIndexRepository->update($request->except(['_token', '_method']), $id);
        return redirect()->route('admin.help.index')->with(['message' => 'Подсказка к странице успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $help = $this->helpIndexRepository->destroy($id);
        return redirect()->back()->with(['message'=> 'Подсказка успешно удалена']);
    }
}
