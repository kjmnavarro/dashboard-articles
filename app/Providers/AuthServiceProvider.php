<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];
    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::define('is-guest', function ($user = null) {
            return is_null($user);
        });

        Gate::define('is-auth', function ($user) {
            return $user !== null;
        });

        Gate::define('write', function (User $user) {
            return $user->type == 'Writer';
        });

        Gate::define('edit', function (User $user) {
            return $user->type == 'Editor';
        });

        Gate::define('update-articles', function (User $user, Article $article) {
            return ($user->id === $article->editor_id || $user->id === $article->writer_id || is_null($article->editor_id)) 
                    && $article->status === 'For Edit';
        });

        Gate::define('edit-articles', function (User $user, Article $article) {
            return $user->type == 'Editor' && $article->status === 'For Edit';
        });
    }
}
