<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\User\BaseController;

// Repositories
    use App\Repositories\Admin\User\UserIndexRepository;

class IndexController extends BaseController
{

    protected $userIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userIndexRepository = app(UserIndexRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->userIndexRepository->getUserAll();
        $users = $this->userIndexRepository->getForComboPaginate(30);

        return view('layouts.admin.user.index', compact('users'));
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
    public function store(Request $request)
    {
        //
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
        $user = $this->userIndexRepository->getById($id);

        return view('layouts.admin.user.edit', compact('user'));
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
        $user = $this->userIndexRepository->update($request->except('_token', '_method'), $id);

        return redirect()
                        ->route('admin.user.index')
                        ->with('message', 'Пользователь успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userIndexRepository->destroy($id);

        return redirect()
            ->route('admin.user.index')
            ->with('message', 'Пользователь успешно удален!');
    }
}
