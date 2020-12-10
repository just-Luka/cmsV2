<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Translations\Slider as SliderT;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    private $slider;
    private $sliderT;

    /**
     * SliderController constructor.
     * @param Request $request
     */
    public function __construct(Request $request, Slider $slider, SliderT $sliderT)
    {
        $this->moduleName = 'sliders';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['attachments'] = config('settings.root.slider_attachments');
        $this->data['positions'] = config('settings.root.slider_positions');
        $this->request = $request;
        $this->slider = $slider;
        $this->sliderT = $sliderT;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['current'] = $this->request->type;
        $this->data['items'] = $this->slider->getList($this->data['current'])->paginate(self::PAG_NUM)->appends(['type' => $this->data['current']]);

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
        $this->request->validate(['concrete_attachment' => 'required']);
        $this->slider->create($this->data() + [
                'sort' => $this->slider->getMaxSort() + 1,
                'attachment'    => $this->request->attachment,
                'attachment_id' => $this->request->concrete_attachment
            ]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    private function data(): array
    {
        return [
            'position'      => $this->request->position,
            'visible'       => $this->request->visible,
            'image'         => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
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
        $this->data['items'] = $this->slider->find($id) ?: abort(404);
        $this->data['attached'] = DB::table($this->data['sliderData']->attachment)->find($this->data['sliderData']->attachment_id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $this->slider->find($id)->update($this->data());

        return redirect()->back()->with('updated', 'slider updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->slider->find($id)->delete();

        return response('slider deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->slider->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->sliderT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function transAction($locale, $id)
    {
        $this->request->validate(['meta_title' => 'required|max:255']);
        $itemContent = $this->sliderT->getItem($locale, $id);
        $requests = [
            'meta_title' => $this->request->meta_title,
            'content' => $this->request->tm,
            'slider_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->sliderT->create($requests);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->slider->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
