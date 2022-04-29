<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'Base',
            'User',
            'Hero',
        ];
        foreach ($repositories as $repo) {
            $this->app->bind('App\\Repositories\\' . $repo . '\\' . $repo . 'RepositoryInterface',
                'App\\Repositories\\' . $repo . '\\' . $repo . 'EloquentRepository');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
