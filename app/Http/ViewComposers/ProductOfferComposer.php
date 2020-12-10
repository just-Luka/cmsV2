<?php


namespace App\Http\ViewComposers;


use App\Models\Offer;
use Illuminate\View\View;

class ProductOfferComposer
{
    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        $offers = new Offer();
        $offerData = $offers->where('visible', 1)->orderBy('sort')->with('translation')->get();

        return $view->with('data', ['offers' => $offerData]);
    }
}
