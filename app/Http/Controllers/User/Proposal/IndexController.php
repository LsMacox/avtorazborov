<?php

namespace App\Http\Controllers\User\Proposal;


use App\Http\Controllers\User\Proposal\BaseController;
use Illuminate\Http\Request;

// Repositories
use App\Repositories\User\Proposal\ProposalIndexRepository;
use App\Repositories\Transport\Cars\MarksRepository as TransportCarMarksRepository;

// Models
use App\Models\Transport\TransportCarMark;
use App\Models\Transport\TransportCarModel;

// Requests
use App\Http\Requests\User\Proposal\StoreRequest;
use App\Http\Requests\User\Proposal\UpdateRequest;

class IndexController extends BaseController
{

    protected $proposalIndexRepository;
    protected $transportCarMarksRepository;

    /**
     * IndexController constructor.
     * @param $proposalIndexRepository
     * @param $transportCarMarksRepository
     */
    public function __construct()
    {
        parent::__construct();
        $this->proposalIndexRepository = app(ProposalIndexRepository::class);
        $this->transportCarMarksRepository = app(TransportCarMarksRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = $this->proposalIndexRepository->getForComboPaginate(30);
        return view('layouts.user.proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marks = $this->transportCarMarksRepository->getPublished();
        return view('layouts.user.proposals.create', compact('marks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $proposal = $this->proposalIndexRepository->create($request->except('_token'));
        return redirect()
                ->route('user.proposal.index')
                ->with('success', 'Заявка успешно подана!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = $this->proposalIndexRepository->getById($id);

        return view('layouts.user.proposals.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal = $this->proposalIndexRepository->getById($id);
        return view('layouts.user.proposals.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $proposal = $this->proposalIndexRepository->update($request->except('_token', '_method', 'mark', 'model', 'city', 'phone', 'created_at'), $id);
        return redirect()
                ->route('user.proposal.index')
                ->with('success', 'Заявка успешно сохранена!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposal = $this->proposalIndexRepository->getById($id);
        $proposal->delete();
        return redirect()
                ->back()
                ->with('success', "Заявка успешно удалена!");
    }
}
