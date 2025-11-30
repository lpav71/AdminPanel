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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Примечание: Кастомные view elFinder находятся в resources/views/custom/elfinder/
        // После composer update нужно скопировать их обратно в resources/views/vendor/elfinder/
        // См. README_ELFINDER.md для подробностей
    }
}
