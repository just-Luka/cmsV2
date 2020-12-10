<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Category;
use App\Models\Translations\Category as CategoryT;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $categoryT;

    private $rules = [
        'slug' => 'required|unique:categories|min:2|max:255'
    ];

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->validate($this->request, $this->rules);
        $this->category->create($this->data() + ['sort' => $this->category->getMaxSort() + 1]);

        return redirect()->route('backend.' . $this->moduleName . '.index', ['locale' => $locale]);
    }

    /**
     * @return array
     */
    private function data()
    {
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
        $this->data['item'] = $this->category->find($id) ?: abort(404);

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
        $item = $this->category->find($id);
        if($item->slug !== $this->request->slug){
            $this->validate($this->request, $this->rules);
        }
        $item->update($this->data());

        return redirect()->back()->with('updated', 'category updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->category->find($id)->delete();

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
        $this->data['item'] = $this->category->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->categoryT->getItem($locale, $id);

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
        $itemContent = $this->categoryT->getItem($locale, $id);
        if ($itemContent) {
            if($itemContent->title !== $this->request->title) {
                $this->request->validate(['title' => 'required|unique:category_trans|min:2|max:255' ]);
            }
        }

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
        $item = $this->category->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
