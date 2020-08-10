<?php

namespace App\Http\Controllers\Admin\Proposal;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Proposal\BaseController;

// Requests
use App\Http\Requests\Admin\Proposal\UpdateRequest;

// Models
use App\Models\User;
use App\Models\Transport\TransportCarMark;
use App\Models\Transport\TransportCarModel;

// Repositories
use App\Repositories\Transport\Cars\MarksRepository as TransportCarMarksRepository;
use App\Repositories\Admin\Proposal\ProposalIndexRepository;
use App\Repositories\Location\CitiesIndexRepository;
use App\Repositories\Admin\Profile\ProfileIndexRepository;
use App\Repositories\Media\MediaIndexRepository;


class IndexController extends BaseController
{

    protected $proposalIndexRepository;
    protected $transportCarMarksRepository;
    protected $citiesRepository;
    protected $profileIndexRepository;
    protected $mediaIndexRepository;

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
        $this->citiesRepository = app(CitiesIndexRepository::class);
        $this->profileIndexRepository = app(ProfileIndexRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = $this->proposalIndexRepository->getForComboPaginate(30);
        $marks = $this->transportCarMarksRepository->getAll();
        $cities = $this->citiesRepository->getAll();
        return view('layouts.admin.proposals.index', compact('proposals','marks', 'cities'));
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
        $proposal = $this->proposalIndexRepository->getById($id);

        $user = User::with('user_setting')->where('id', $proposal->user_id)->first();

        return view('layouts.admin.proposals.show', compact('proposal', 'user'));
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
        return view('layouts.admin.proposals.edit', compact('proposal'));
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
        $proposal = $this->proposalIndexRepository->update($request->except('_token', '_method'), $id);
        return redirect()
                ->route('admin.proposal.index')
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
