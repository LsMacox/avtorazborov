<?php

namespace App\Http\Controllers\Admin\Synonym;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Synonym\BaseController;

// Repositories
use App\Repositories\Admin\Synonym\SynonymTransportNameRepository;
use App\Repositories\Admin\Synonym\SynonymTransportSynonymRepository;

// Requests
use App\Http\Requests\Admin\Synonym\TransportWordRequest;
use App\Http\Requests\Admin\Synonym\TransportSynonymRequest;

class TransportController extends BaseController
{

    protected $synonymTransportWordRepository;
    protected $synonymTransportSynonymRepository;

    public function __construct()
    {
        parent::__construct();
        $this->synonymTransportWordRepository = app(SynonymTransportNameRepository::class);
        $this->synonymTransportSynonymRepository = app(SynonymTransportSynonymRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $synonyms = $this->synonymTransportWordRepository->getForComboPaginate(6);

        return view('layouts.admin.db.synonyms.transport.index', compact('synonyms'));
    }

    public function getAll()
    {
        $words = $this->synonymTransportWordRepository->getAll();

        return response()->json($words);
    }


    public function getPaginateFetchData(Request $request)
    {
        if ($request->ajax())
        {
            $synonyms = $this->synonymTransportWordRepository->getForComboPaginate(6);
            return view('components.admin.pagination.db.synonym_pagination', compact('synonyms'))->render();
        }
    }

    public function getAllFetchData(Request $request)
    {
        if ($request->ajax())
        {
            $words = $this->synonymTransportWordRepository->getAll();
            return response()->json($words);
        }
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
     * @param TransportWordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeWord(TransportWordRequest $request)
    {
        $word = $this->synonymTransportWordRepository->create($request->all());

        return response()->json($word->paginate(6)->lastPage());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransportSynonymRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSynonym(TransportSynonymRequest $request)
    {
        $synonym = $this->synonymTransportSynonymRepository->create($request->all());

        return response()->json($synonym);
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
        $word = $this->synonymTransportWordRepository->getById($id);

        return view('layouts.admin.db.synonyms.transport.edit', compact('word'));
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
        $this->synonymTransportWordRepository->update($request->all(), $id);

        return redirect()->route('admin.db.synonym.transport.index')->with('success', 'Успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyWord($id)
    {
        $word = $this->synonymTransportWordRepository->destroy($id);

        return redirect()->route('admin.db.synonym.transport.index')->with('success', 'Успешно удалено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySynonym($id)
    {
        $synonym = $this->synonymTransportSynonymRepository->getById($id);
        $synonym->delete();
    }
}
