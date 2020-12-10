<?php

namespace App\Http\ViewComposers;

use App\Models\Slider;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class SliderComposer {

    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
     {
         $slider = new Slider();
         $sliderData = $slider->getFrontList('top');

         return $view->with('sliderData', $sliderData);
     }
}
