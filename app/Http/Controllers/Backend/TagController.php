<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Translations\Tag as TagT;

class TagController extends Controller
{
    private $tag;
    private $tagT;
    private $rules = [
        'slug' => 'required|unique:tags|min:2|max:255'
    ];

    /**
     * TagController constructor.
     * @param Request $request
     */
    public function __construct(Request $request, Tag $tag, TagT $tagT)
    {
        $this->moduleName = 'tags';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['tags'] = config('settings.root.tags');
        $this->request = $request;
        $this->tag = $tag;
        $this->tagT = $tagT;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['current'] = $this->request->type;
        $this->data['items'] = $this->tag->getList($this->data['current'])->paginate(self::PAG_NUM)->appends(['type' => $this->data['current']]);

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->request->validate($this->rules);
        $this->tag->create($this->data() + ['sort' => $this->tag->getMaxSort() + 1]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    public function data()
    {
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
        $this->data['item'] = $this->tag->find($id) ?: abort(404);

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
        $item = $this->tag->find($id);
        if($item->slug !== $this->request->slug){
            $this->validate($this->request, $this->rules);
        }
        $item->update($this->data());

        return redirect()->back()->with('updated', 'tag updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->tag->find($id)->delete();

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
        $this->data['item'] = $this->tag->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->tagT->getItem($locale, $id);

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
        $item = $this->tagT->getItem($locale, $id);
        if ($item) {
            if($item->title !== $this->request->title) {
                $this->request->validate(['title' => 'required|unique:tag_trans|min:2|max:255' ]);
            }
        }
        $requests = [
            'title'        => $this->request->title,
            'tag_id'      => $id,
            'lang_slug'   => $locale,
        ];
        $item ? $item->update($requests) : $this->tagT->create($requests);

        return redirect()->back()->with('saved', 'trans saved successfully!');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->tag->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
