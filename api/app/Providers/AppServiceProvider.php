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
        $this->app->bind('App\Contracts\Service\Admin\ScheduleServiceInterface', 'App\Service\Admin\ScheduleService');


        // Dao
        $this->app->bind('App\Contracts\Dao\Admin\AdminDaoInterface', 'App\Dao\Admin\AdminDao');
        $this->app->bind('App\Contracts\Dao\Admin\PaymentDaoInterface', 'App\Dao\Admin\PaymentDao');
        $this->app->bind('App\Contracts\Dao\Admin\ScheduleDaoInterface', 'App\Dao\Admin\ScheduleDao');
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
