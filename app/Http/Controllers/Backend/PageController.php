<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Media;
use App\Models\Page;
use App\Models\RefMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Translations\Page as PageT;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    private $page;
    private $pageT;

    /**
     * PageController constructor.
     * @param Request $request
     * @param Page $page
     * @param PageT $pageT
     */
    public function __construct(Request $request, Page $page, PageT $pageT)
    {
        $this->moduleName = 'pages';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['templates'] = config('settings.root.page_templates');
        $this->page = $page;
        $this->pageT = $pageT;
        $this->request = $request;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->page->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param null $parentID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale, $parentID=null)
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
        $this->page->create($this->data() + [ 'sort' => $this->page->getSort()]);

        return redirect()->route('backend.'.$this->moduleName.'.index', ['locale'=>$locale]);
    }

    /**
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('pages')->ignore($id)],
        ]);

        return [
            'slug' => $this->request->slug,
            'template' => $this->request->template,
            'image' => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
            'visible' => $this->request->visible ?? 0,
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
        $this->data['item'] = $this->page->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($locale, $id)
    {
        $item = $this->page->findOrFail($id);
        $item->update($this->data($item->id));

        return redirect()->back()->with('updated', 'Page updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->page->findOrFail($id)->delete();

        return response('page deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @param Media $media
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id, Media $media)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->page->findOrFail($id);
        $this->data['itemContent'] = $this->pageT->getItem($locale, $id);
        $this->data['mediaFileData'] = $media->getMediaByRef($this->moduleName, $id);
        $this->data['fileString'] = FileLib::fileToString($this->data['mediaFileData']);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @param RefMedia $refMedia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id, RefMedia $refMedia)
    {

        $referenceMedia = $refMedia->getList($this->moduleName, $id);

        if ($referenceMedia->get()) {
            $referenceMedia->delete();
        }

        if ($this->request->has('filepath')){
            $multipleFiles = explode('|||', $this->request->filepath);
            foreach ($multipleFiles as $file) {
                $refMedia->makeConnection($file, $this->moduleName, $id);
            }
        }

        $itemContent = $this->pageT->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'meta_title' => $this->request->meta_title,
            'content' => $this->request->tm,
            'page_id' => $id,
            'lang_slug' => $locale,
        ];

        $itemContent ? $itemContent->update($requests) : $this->pageT->create($requests);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->page->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }

}
