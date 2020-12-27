<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Translations\Brand as BrandT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends BaseController
{
    /**
     * BrandController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'brands';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->setModel(new Brand());
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

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $this->model->create($this->data() + ['sort' => $this->model->getSort()]); /* TODO `sort` set in model as default increment value */

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
        $this->data['item'] = $this->model->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $item = $this->model->findOrFail($id);
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
        $this->model->findOrFail($id)->delete();

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
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['itemContent'] = (new BrandT())->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new BrandT());
        $itemContent = $this->model->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'brand_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', '200');
    }
}
