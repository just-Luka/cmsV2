<?php

namespace App\Providers;

use App\Http\ViewComposers\AboutBannerComposer;
use App\Http\ViewComposers\AboutCommunityComposer;
use App\Http\ViewComposers\AboutImageComposer;
use App\Http\ViewComposers\AboutSubjectComposer;
use App\Http\ViewComposers\AboutVideoComposer;
use App\Http\ViewComposers\OfferComposer;
use App\Http\ViewComposers\ProductComposer;
use App\Http\ViewComposers\ProductOfferComposer;
use App\Http\ViewComposers\SliderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
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
        /* Frontend */
        View::composer(['frontend.blocks.slider'], SliderComposer::class);
        View::composer(['frontend.blocks.event'], OfferComposer::class);
        View::composer(['frontend.blocks.product'], ProductComposer::class);
        View::composer(['frontend.blocks.offer'], ProductOfferComposer::class);
    }
}
