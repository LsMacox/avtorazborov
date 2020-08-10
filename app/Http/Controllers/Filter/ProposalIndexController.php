<?php

namespace App\Http\Controllers\Filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Filter\ProposalIndexRepository as FilterProposalIndexRepository;

class ProposalIndexController extends BaseController
{

    protected $filterProposalIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->filterProposalIndexRepository = app(FilterProposalIndexRepository::class);
    }

    public function index(Request $request)
    {
        $filter = $this->filterProposalIndexRepository->indexFilter($request);

        return response()->json($filter);
    }

    public function answered(Request $request)
    {
        $filter = $this->filterProposalIndexRepository->answeredFilter($request);

        return response()->json($filter);
    }

}
