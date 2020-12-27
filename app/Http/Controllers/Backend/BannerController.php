<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Models\Banner;
use App\Models\Translations\Banner as BannerT;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    /**
     * BannerController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'banners';
        $this->templateName = 'modules.' . $this->moduleName . '.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['types'] = config('settings.root.banner_types');
        $this->request = $request;
        $this->setModel(new Banner());
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['current'] = $this->request->type;
        $this->data['items'] = $this->model->getList($this->data['current'])->paginate(self::PAG_NUM)->appends(['type' => $this->data['current']]);

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
        $this->model->create($this->data() + ['sort' => $this->model->getSort()]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    private function data(): array
    {
        if ($this->request->url)
            $this->request->validate(['url' => 'url|max:255']);

        return [
            'url'     => $this->request->url,
            'visible' => $this->request->visible,
            'src'     => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
            'type'    => $this->request->position,
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
        $this->model->findOrFail($id)->update($this->data());

        return redirect()->back()->with('updated', 'banner updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

        return response('banner deleted successfully', '200');
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
        $this->data['itemContent'] = (new BannerT())->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new BannerT());
        $itemContent = $this->model->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'meta_title' => $this->request->meta_title,
            'content' => $this->request->tm,
            'banner_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', '200');
    }
}
