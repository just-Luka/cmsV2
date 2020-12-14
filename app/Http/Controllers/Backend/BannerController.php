<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Translations\Banner as BannerT;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $banner;
    private $bannerT;

    /**
     * BannerController constructor.
     * @param Request $request
     * @param Banner $banner
     * @param BannerT $bannerT
     */
    public function __construct(Request $request, Banner $banner, BannerT $bannerT)
    {
        $this->moduleName = 'banners';
        $this->templateName = 'modules.' . $this->moduleName . '.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['types'] = config('settings.root.banner_types');
        $this->banner = $banner;
        $this->bannerT = $bannerT;
        $this->request = $request;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['current'] = $this->request->type;
        $this->data['items'] = $this->banner->getList($this->data['current'])->paginate(self::PAG_NUM)->appends(['type' => $this->data['current']]);

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
        $this->banner->create($this->data() + ['sort' => $this->banner->getSort()]);

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
            'visible' => $this->request->visible || 0,
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
        $this->data['item'] = $this->banner->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $this->banner->findOrFail($id)->update($this->data());

        return redirect()->back()->with('updated', 'banner updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->banner->findOrFail($id)->delete();

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
        $this->data['item'] = $this->banner->findOrFail($id);
        $this->data['itemContent'] = $this->bannerT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $itemContent = $this->bannerT->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'meta_title' => $this->request->meta_title,
            'content' => $this->request->tm,
            'banner_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->bannerT->create($requests);

        return redirect()->back()->with('updated', '200');
    }


    /** TODO move it to trait Http/Controllers/Traits
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->banner->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
