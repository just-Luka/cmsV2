<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Offer;

class OfferController extends BaseController
{
    /**
     * OfferController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'offers';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @param Offer $offer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Offer $offer)
    {
        $this->templateName .= 'index';
        $this->data['item'] = $offer->frontItem($slug);

        return view($this->templateName, $this->data);
    }
}
