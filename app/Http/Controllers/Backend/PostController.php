<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Traits\AttachableTrait;
use App\Models\Category;
use App\Models\Post;
use App\Models\RefCategory;
use App\Models\Translations\Post as PostT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    use AttachableTrait;

    private $post;
    private $postT;
    private $category;

    /**
     * PostController constructor.
     * @param Request $request
     * @param Post $post
     * @param PostT $postT
     * @param Category $category
     */
    public function __construct(Request $request, Post $post, PostT $postT, Category $category)
    {
        $this->moduleName = 'posts';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['templates'] = config('settings.root.post_templates');
        $this->request = $request;
        $this->post = $post;
        $this->postT = $postT;
        $this->category = $category;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->post->with('translation')->paginate(self::PAG_NUM);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($locale)
    {
        $this->templateName .= 'create';
        $this->data['categories'] = $this->category->getList($this->moduleName)->get();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $item = $this->post->create($this->data() + ['sort' => $this->post->getSort()]);
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
            'image' => FileLib::fileParse($this->request->filepath)['full_src'] ?? null,
            'visible' => $this->request->visible || 0,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id, RefCategory $refCategory)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->post->findOrFail($id);
        $this->data['categories'] = $this->category->getList($this->moduleName)->get();

        $categoryIds = $refCategory->getList($this->moduleName, $id)->pluck('category_id');
        $this->data['myCategories'] = $this->category->myCategories($categoryIds);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $item = $this->post->findOrFail($id);
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
        $this->post->findOrFail($id)->delete();

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
        $this->data['item'] = $this->post->findOrFail($id);
        $this->data['itemContent'] = $this->postT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $itemContent = $this->postT->getItem($locale, $id);
        $requests = [
            'title' => $this->request->title,
            'content' => $this->request->tm,
            'post_id' => $id,
            'lang_slug' => $locale,
        ];
        $itemContent ? $itemContent->update($requests) : $this->postT->create($requests);

        return redirect()->back()->with('updated', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->post->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
