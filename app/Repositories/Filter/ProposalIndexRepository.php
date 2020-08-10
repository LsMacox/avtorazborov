<?php

namespace App\Repositories\Filter;

use App\Models\Message;
use App\Models\Proposal as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use App\Http\Filters\ProposalFilter;

/**
 * Class ProposalIndexRepository
 *
 * @package App\Repositories
 */
class ProposalIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function indexFilter($request)
    {
        $proposals = $this->startConditions();

        $proposals = (new ProposalFilter($proposals, $request))->apply()->get();

        return $proposals;
    }

    public function answeredFilter($request)
    {
        $messages = Message::where('from', auth()->id())->get();

        $proposals = $this->startConditions()->get();

        $proposals = $proposals
                            ->filter(function($proposal) use ($messages) {
                                foreach ($messages as $message)
                                {
                                    return $proposal->id === $message->proposal_id;
                                }
                            });

        $proposals = (new ProposalFilter($proposals, $request))->apply()->get();

        return $proposals;
    }

}