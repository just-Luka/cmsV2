<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Translations\Tag as TagT;
use Illuminate\Validation\Rule;

class TagController extends BaseController
{
    /**
     * TagController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'tags';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['tags'] = config('settings.root.tags');
        $this->request = $request;
        $this->setModel(new Tag());
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
     * @param null $id
     * @return array
     */
    public function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('tags')->ignore($id)],
        ]);
        return [
            'slug' => $this->request->slug,
            'tag_of' => $this->request->type,
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

        return redirect()->back()->with('updated', 'tag updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

        return response('Tag deleted successfully', '200');
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
        $this->data['itemContent'] = (new TagT())->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new TagT());
        $item = $this->model->getItem($locale, $id);

        $requests = [
            'title'        => $this->request->title,
            'tag_id'      => $id,
            'lang_slug'   => $locale,
        ];
        $item ? $item->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', 'trans saved successfully!');
    }
}
