<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Facades\ProductFacade;
use App\Http\Controllers\Traits\AttachableTrait;
use App\Models\OfferProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Translations\Offer as OfferT;
use Illuminate\Validation\Rule;

class OfferController extends BaseController
{
    use AttachableTrait;

    /**
     * OfferController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'offers';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->setModel(new Offer());
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->model->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';
        $this->data['products'] = (new Product())->with('translation')->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $item = $this->model->create($this->data() + ['sort' => $this->model->getSort(),  'offer_end' => $this->request->offer_end]);
        $this->attachOffer($item->id);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @param null $id
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('offers')->ignore($id)],
        ]);

        return [
            'slug'    => $this->request->slug,
            'price'   => $this->request->price,
            'visible' => $this->request->visible,
            'image'   => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id, Product $product)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['products'] = $product->with('translation')->get();
        $this->data['myProducts'] = (new ProductFacade())->relatedItems($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $this->request->validate(['price' => 'required|numeric|gt:0']);
        $item = $this->model->findOrFail($id);

        $offerDate = $this->request->offer_end ?: $this->request->old_time;
        $item->update($this->data($item->id) + ['offer_end' => $offerDate]);
        $this->attachOffer($id);

        return redirect()->back()->with('updated', 'Offer updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

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
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['itemContent'] = (new OfferT())->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new OfferT());
        $itemContent = $this->model->getItem($locale, $id);
        $requests = [
            'title'     => $this->request->title,
            'content'   => $this->request->tm,
            'offer_id'  => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', '200');
    }

}
