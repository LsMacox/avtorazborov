<?php

namespace App\Observers\User\MailList;

use App\Models\Proposal;
use App\Models\Region;
use App\Models\City;

// Alert
use App\Models\Alert\ShopProfileAlert;
use App\Models\Alert\ShopProfileAlertRegion;
use App\Models\Alert\ShopProfileAlertSynonym;
use App\Models\ShopTransportInStock;
use App\Models\Synonym\SynonymTransportName;
use App\Models\Synonym\SynonymTransportSynonym;
use App\Mail\ProposalAlertRightAway;

class MailListObserver
{

    public function mailingList(Proposal $proposal)
    {
        $city = City::where('title', $proposal->city)->first()->region_id;
        if (!empty($city)) $region = Region::find(City::where('title', $proposal->city)->first()->region_id)->title;

        foreach (ShopProfileAlert::where('often_receive_notification', 'right_away')->cursor() as $shop_profile_alert)
        {
            $shop_profile_alert_regions = ShopProfileAlertRegion::where('user_id', $shop_profile_alert->user_id);
            $shop_profile_alert_synonyms = ShopProfileAlertSynonym::where('user_id', $shop_profile_alert->user_id);
            $shop_profile_alert_transport_in_stock = ShopTransportInStock::where('user_id', $shop_profile_alert->user_id)->where('alert', 1);
            if (
                !empty($region) &&
                $shop_profile_alert_regions->where('name', $region)->count() > 0 &&
                $shop_profile_alert_transport_in_stock->where('mark', $proposal->mark)->count() > 0 &&
                $shop_profile_alert_transport_in_stock->where('model', $proposal->model)->count() > 0 &&
                $shop_profile_alert_transport_in_stock->where('year_from', '<=', $proposal->year_of_issue)
                    ->where('year_before', '>=', $proposal->year_of_issue)->count() > 0
            )
            {
                $proposal_text_1 = explode(" ", $proposal->spares);
                $proposal_text_2 = explode(", ", $proposal->spares);
                $result = '';
                $percent = 75;

                foreach ($shop_profile_alert_synonyms->get() as $shop_profile_alert_synonym)
                {
                    $synonym_name = SynonymTransportName::where('name', $shop_profile_alert_synonym->name)->first();
                    $synonyms = SynonymTransportSynonym::where('synonym_transport_name_id', $synonym_name->id);

                    foreach ($proposal_text_1 as $text)
                    {
                        $sim = similar_text(trim($text), trim($shop_profile_alert_synonym->name), $perc);
                        if (round($perc) > $percent)
                        {
                            $result = round($perc);
                            break;
                        }
                    }

                    if (empty($result))
                    {
                        foreach ($proposal_text_2 as $text)
                        {
                            $sim = similar_text(trim($text), trim($shop_profile_alert_synonym->name), $perc);
                            if (round($perc) > $percent)
                            {
                                $result = round($perc);
                                break;
                            }
                        }
                    }
                    if (empty($result))
                    {
                        foreach ($synonyms->cursor() as $synonym)
                        {
                            foreach ($proposal_text_1 as $text)
                            {
                                $sim = similar_text(trim($text), trim($synonym->name), $perc);
                                if (round($perc) > $percent)
                                {
                                    $result = round($perc);
                                    break;
                                }
                            }

                            if (empty($result))
                            {
                                foreach ($proposal_text_2 as $text)
                                {
                                    $sim = similar_text(trim($text), trim($synonym->name), $perc);
                                    if (round($perc) > $percent)
                                    {
                                        $result = round($perc);
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($result) && $result > $percent)
            {
                Mail::to($shop_profile_alert->email)->send(new ProposalAlertRightAway($proposal));
            }

        }

    }

    /**
     * Handle the proposal "created" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function created(Proposal $proposal)
    {
        $this->mailingList($proposal);
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
        //
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
        //
    }
}
