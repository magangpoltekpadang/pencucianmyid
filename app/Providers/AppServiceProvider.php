<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()-> runningInConsole()){
            try {
                DB::connection()->getPdo();

                if(rand(1, 10) <= 2) {
                    echo "koneksi intermittent (tidak stabil)";
                } else{
                    echo " koneksi sukses";
                }
            } catch (Exception $e) {
                echo "koneksi gagal: " . $e->getMessage();
            }
        }
    }
}
