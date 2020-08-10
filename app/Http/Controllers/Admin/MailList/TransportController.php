<?php

namespace App\Http\Controllers\Admin\MailList;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MailList\BaseController;

// Repositories
use App\Repositories\Admin\MailList\MailListTransportRepository;

// Requests
use App\Http\Requests\Admin\MailList\Transport\UpdateRequest;

class TransportController extends BaseController
{

    protected $mainListTransportRepository;

    public function __construct()
    {
        parent::__construct();
        $this->mainListTransportRepository = app(MailListTransportRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function available($user_id)
    {
        $transport = $this->mainListTransportRepository->available($user_id);

        return $transport;
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
        $transport = $this->mainListTransportRepository->store(["user_id" => $request->user_id, "transport" => $request->transport]);

        return response()->json($transport);
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
        $transport = $this->mainListTransportRepository->getById($id);

        return view('layouts.admin.mail_list.transport_edit', compact('transport'));
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
        $this->mainListTransportRepository->update($request->except('_token', '_method'), $id);

        return redirect()
            ->route('admin.mail-list.index')
            ->with('success', 'Успешно изменено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport = $this->mainListTransportRepository->getById($id);
        $transport->delete();
    }
}
