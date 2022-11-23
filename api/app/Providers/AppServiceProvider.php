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
        // Service
        $this->app->bind('App\Contracts\Service\Admin\AdminServiceInterface', 'App\Service\Admin\AdminService');
        $this->app->bind('App\Contracts\Service\Admin\PaymentServiceInterface', 'App\Service\Admin\PaymentService');



        // Dao
        $this->app->bind('App\Contracts\Dao\Admin\AdminDaoInterface', 'App\Dao\Admin\AdminDao');
        $this->app->bind('App\Contracts\Dao\Admin\PaymentDaoInterface', 'App\Dao\Admin\PaymentDao');
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
