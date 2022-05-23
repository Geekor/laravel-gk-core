<?php

namespace Geekor\Core;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use Geekor\Core\Consts;

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
        $this->loadTranslationsFrom(__DIR__.'/../lang', Consts::LANG_NAMESPACE);


        // TODO:
        //-------
        // 目前来说没必要把翻译发布出去，
        // 后续可以考虑通过调用命令的方式发布到主项目
        //
        // if (app()->runningInConsole()) {
        //     $this->publishes([
        //         __DIR__.'/../lang/' => lang_path('vendor/' . AppConst::LANG_NAMESPACE),
        //     ], AppConst::LANG_NAMESPACE . '-lang');
        // }

    }
}
