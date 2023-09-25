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
            'App\Repositories\MailSenderRepository',
            function () {
                $repository = new \App\Repositories\Eloquent\EloquentMailSenderRepository(new \App\Models\MailSenders());
                return $repository;
            }
        );
        $this->app->bind(
            'App\Repositories\EmailsRepository',
            function () {
                $repository = new \App\Repositories\Eloquent\EloquentEmailsRepository(new \App\Models\Email());
                return $repository;
            }
        );

        $this->app->bind(
            'App\Repositories\UsersRepository',
            function () {
                $repository = new \App\Repositories\Eloquent\EloquentUsersRepository(new \App\Models\User());
                return $repository;
            }
        );
    }
}
