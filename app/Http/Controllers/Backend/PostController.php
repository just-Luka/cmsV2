<?php

namespace App\Http\Controllers\Backend;

use App\Facades\CategoryFacade;
use App\Facades\FileLib;
use App\Http\Controllers\Traits\AttachableTrait;
use App\Models\Category;
use App\Models\Post;
use App\Models\RefCategory;
use App\Models\Translations\Post as PostT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends BaseController
{
    use AttachableTrait;

    /**
     * PostController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'posts';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['templates'] = config('settings.root.post_templates');
        $this->request = $request;
        $this->setModel(new Post());
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
        $this->data['categories'] = (new Category())->getList($this->moduleName)->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $item = $this->model->create($this->data() + ['sort' => $this->model->getSort()]);
        $this->attachCategory($item->id);

        return redirect()->route('backend.'.$this->moduleName.'.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('posts')->ignore($id)],
        ]);

        return [
            'slug' => $this->request->slug,
            'template' => $this->request->template,
            'image' => FileLib::getImage($this->request->filepath)['full_src'],
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
        $this->data['categories'] = (new Category())->getList($this->moduleName)->get();
        $this->data['myCategories'] = (new CategoryFacade($this->moduleName))->relatedItems($id);

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
        $this->attachCategory($id);

        return redirect()->back()->with('updated', 'Post updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

        return response('Post deleted successfully', '200');
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
        $this->data['itemContent'] = (new PostT())->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new PostT());
        $itemContent = $this->model->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'content' => $this->request->tm,
            'post_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->model->create($requests);

        return redirect()->back()->with('updated', '200');
    }
}
