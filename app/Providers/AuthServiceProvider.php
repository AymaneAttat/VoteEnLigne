<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Vote' => 'App\Policies\VotePolicy',
        'App\Models\Condidat' => 'App\Policies\CondidatPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('index.vote.condidat', function (User $user) {
            //return $user->is_admin;
            return in_array($user->role_id, [1, 4]);
        });
        Gate::define('countVote', function (User $user) {
            return in_array($user->role_id, [1, 3]);
        });

        //Gate::before(function ($user, $ability) {
        //    if ($user->is_admin ){
        //        return true;
        //    }
        //});
    }
}
