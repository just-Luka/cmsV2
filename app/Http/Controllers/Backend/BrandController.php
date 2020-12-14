<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Brand;
use App\Models\Translations\Brand as BrandT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    private $brand;
    private $brandT;

    /**
     * BrandController constructor.
     * @param Request $request
     * @param Brand $brand
     * @param BrandT $brandT
     */
    public function __construct(Request $request, Brand $brand, BrandT $brandT)
    {
        $this->moduleName = 'brands';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->brand = $brand;
        $this->brandT = $brandT;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->brand->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $this->brand->create($this->data() + ['sort' => $this->brand->getSort()]); /* TODO `sort` set in model as default increment value */

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @param null $id
     * @return array
     */
    private function data($id=null): array
    {
        $this->request->validate([
                'slug' => ['required', 'min:2', 'max:255', Rule::unique('brands')->ignore($id)],
        ]);

        return [
            'slug'    => $this->request->slug,
            'visible' => $this->request->visible,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->brand->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $item = $this->brand->findOrFail($id);
        $item->update($this->data($item->id));

        return redirect()->back()->with('updated', 'brand updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->brand->findOrFail($id)->delete();

        return response('brands deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->brand->findOrFail($id);
        $this->data['itemContent'] = $this->brandT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $itemContent = $this->brandT->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'brand_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->brandT->create($requests);

        return redirect()->back()->with('updated', '200');
    }


    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->brand->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
