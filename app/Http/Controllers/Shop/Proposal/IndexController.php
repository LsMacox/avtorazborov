<?php

namespace App\Http\Controllers\Shop\Proposal;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\Proposal\BaseController;

// Models
use App\Models\User;

// Repositories
use App\Repositories\Transport\Cars\MarksRepository as TransportCarMarksRepository;
use App\Repositories\Proposal\ProposalIndexRepository;
use App\Repositories\Shop\Profile\ProfileIndexRepository;
use App\Repositories\Location\CitiesIndexRepository;
use App\Repositories\Media\MediaIndexRepository;

class IndexController extends BaseController
{

    protected $proposalIndexRepository;
    protected $transportCarMarksRepository;
    protected $profileIndexRepository;
    protected $citiesIndexRepository;
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
        $this->profileIndexRepository = app(ProfileIndexRepository::class);
        $this->mediaIndexRepository = app(MediaIndexRepository::class);
        $this->citiesIndexRepository = app(CitiesIndexRepository::class);
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
        $cities = $this->citiesIndexRepository->getAll();
        return view('layouts.shop.proposals.index', compact('proposals','marks', 'cities'));
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

    public function answers()
    {
        $proposals = $this->proposalIndexRepository->getAnsweredProposals();
        $marks = $this->transportCarMarksRepository->getAll();
        $cities = $this->citiesIndexRepository->getAll();

        return view('layouts.shop.additionally.your_answer', compact('proposals','marks', 'cities'));
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
        $user = User::with('shop_setting', 'media')->where('id', auth()->id())->first();

        return view('layouts.shop.proposals.show', compact('proposal', 'user'));
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
    public function destroy($id)
    {
        //
    }
}
