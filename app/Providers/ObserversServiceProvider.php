<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

# Observers
use App\Observers\User\Proposals\ProposalObserver as UserProposalObserver;
use App\Observers\User\MailList\MailListObserver as UserMailListObserver;

# Models
use App\Models\Proposal;

class ObserversServiceProvider extends ServiceProvider
{
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Proposal::observe(UserProposalObserver::class);
        Proposal::observe(UserMailListObserver::class);
    }
}
