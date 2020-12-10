<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\OfferProduct;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Translations\Offer as OfferT;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    private $offer;
    private $offerT;
    private $product;
    private $rules = [
        'price' => 'required|numeric|gt:0'
    ];
    /**
     * OfferController constructor.
     * @param Request $request
     * @param Offer $offer
     * @param OfferT $offerT
     * @param Product $product
     */
    public function __construct(Request $request, Offer $offer, OfferT $offerT, Product $product)
    {
        $this->moduleName = 'offers';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->offer = $offer;
        $this->offerT = $offerT;
        $this->product = $product;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->offer->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';
        $this->data['products'] = $this->product->with('translation')->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $this->request->validate($this->rules + [ 'slug' => 'required|unique:offers|min:2|max:255']);
        $item = $this->offer->create($this->data() + ['sort' => $this->offer->getMaxSort() + 1,  'offer_end' => $this->request->offer_end]);
        $this->attachOffers($item->id);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'slug' => $this->request->slug,
            'price' => $this->request->price,
            'visible' => $this->request->visible,
            'image'     => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @param OfferProduct $offerProduct
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id, OfferProduct $offerProduct)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->offer->find($id) ?: abort(404);
        $this->data['products'] = $this->product->with('translation')->get();

        $productIds = $offerProduct->getList($id)->pluck('product_id');
        $this->data['myProducts'] = $this->product->myProducts($productIds);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $this->request->validate($this->rules);
        $item = $this->offer->find($id);
        if ($item->slug !== $this->request->slug){
            $this->request->validate([ 'slug' => 'required|unique:offers|min:2|max:255']);
        }
        $offerDate = $this->request->offer_end ?: $this->request->old_time;

        $item->update($this->data() + ['offer_end' => $offerDate]);
        $this->attachOffers($id);

        return redirect()->back()->with('updated', 'Offer updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $item = $this->offer->find($id)->delete();

        return response('Offer deleted successfully', '200');
    }


    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->offer->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->offerT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $itemContent = $this->offerT->getItem($locale, $id);
        $requests = [
            'title'     => $this->request->title,
            'content'   => $this->request->tm,
            'offer_id'  => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->offerT->create($requests);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->offer->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
