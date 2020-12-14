<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Category;
use App\Models\Translations\Category as CategoryT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    private $category;
    private $categoryT;

    /**
     * CategoryController constructor.
     * @param Request $request
     * @param Category $category
     * @param CategoryT $categoryT
     */
    public function __construct(Request $request, Category $category, CategoryT $categoryT)
    {
        $this->moduleName = 'categories';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['types'] = config('settings.root.categories');
        $this->request = $request;
        $this->category = $category;
        $this->categoryT = $categoryT;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['current'] = $this->request->type;
        $this->data['items'] = $this->category->getList($this->data['current'])->paginate(self::PAG_NUM)->appends($this->data['current']);

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
        $this->category->create($this->data() + ['sort' => $this->category->getSort()]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @param null $id
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'slug' => ['required', 'min:2', 'max:255', Rule::unique('categories')->ignore($id)],
            ]);

        return [
            'slug' => $this->request->slug,
            'category_of' => $this->request->type,
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
        $this->data['item'] = $this->category->findOrFail($id);

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
        $item = $this->category->findOrFail($id);
        $item->update($this->data($item->id));

        return redirect()->back()->with('updated', 'category updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->category->findOrFail($id)->delete();

        return response('Category deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->category->findOrFail($id);
        $this->data['itemContent'] = $this->categoryT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $itemContent = $this->categoryT->getItem($locale, $id);

        $request = [
            'title'       => $this->request->title,
            'category_id' => $id,
            'lang_slug'   => $locale,
        ];
        $itemContent ? $itemContent->update($request) : $this->categoryT->create($request);

        return redirect()->back()->with('saved', 'name saved successfully!');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->category->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
