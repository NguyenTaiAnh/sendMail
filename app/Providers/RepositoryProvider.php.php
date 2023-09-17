<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerBindings()
    {

        $this->app->bind(
            'App\Repositories\MailSenderService',
            function () {
                $repository = new \App\Repositories\Eloquent\EloquentMailSenderRepository(new \App\Models\MailSenders());
                return $repository;
            }
        );
    }
}