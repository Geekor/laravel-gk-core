<?php

namespace Geekor\Core;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
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
        $this->loadTranslations();
    }

    /**
     * 导入翻译
     */
    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', AppConst::LANG_NAMESPACE);

        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../lang/' => lang_path('vendor/' . AppConst::LANG_NAMESPACE),
            ], AppConst::LANG_NAMESPACE . '-lang');
        }

    }
}
