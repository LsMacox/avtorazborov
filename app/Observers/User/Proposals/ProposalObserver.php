<?php

namespace App\Observers\User\Proposals;

use App\Models\Proposal;
use Auth;
use Carbon\Carbon;
use \Illuminate\Validation\ValidationException;

class ProposalObserver
{

    /**
     * @param array $data
     * @return bool
     */
    protected function validateSubmitTimeProposal(array $data)
    {
        $proposalDb = Proposal::where('user_id', auth()->id())
            ->where(function ($query) use ($data) {
                $query->where('mark', $data['mark']);
                $query->where('model', $data['model']);
                $query->where('year_of_issue', $data['year_of_issue']);
                $query->where('vin', $data['vin']);
                $query->where('engine_number', $data['engine_number']);
                $query->where('spares', $data['spares']);
            })->get();


        $proposalToday = Proposal::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
            ->get();


        if ( $proposalDb->count() > 0 ) {
            return 'DbProposal';
        }
        if ( $proposalToday->count() > 10 ){
            return 'LimitProposal';
        }
        return;
    }

    /**
     * Handle the proposal "created" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function created(Proposal $proposal)
    {

    }

    /**
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function creating(Proposal $proposal) {
        $proposal->user_id = Auth::user()->id;
        $proposal->phone = Auth::user()->login;

        $validateProposal = $this->validateSubmitTimeProposal($proposal->toArray());

        if ( $validateProposal == 'DbProposal' ) {
            return redirect()
                ->back()
                ->withErrors([
                    'DbProposal' => "Нельзя кидать одинаковые заявки в один и тот же день.",
                ])->send();
            return false;
        }

        if ( $validateProposal == 'LimitProposal' ) {
            return redirect()
                ->back()
                ->withErrors([
                    'LimitProposal' => "Максимальное кол-во заявок в день: 10",
                ])->send();
            return false;
        }
    }

    /**
     * Handle the proposal "updated" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function updated(Proposal $proposal)
    {
        //
    }

    /**
     * Handle the proposal "deleted" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function deleted(Proposal $proposal)
    {

    }

    /**
     * Handle the proposal "restored" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function restored(Proposal $proposal)
    {
        //
    }

    /**
     * Handle the proposal "force deleted" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function forceDeleted(Proposal $proposal)
    {

    }
}
