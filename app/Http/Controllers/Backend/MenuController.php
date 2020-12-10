<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Translations\Menu as menuT;

class MenuController extends Controller
{
    private $menu;
    private $menuT;
    private $page;

    /**
     * MenuController constructor.
     * @param Request $request
     * @param Menu $menu
     * @param menuT $menuT
     * @param Page $page
     */
    public function __construct(Request $request, Menu $menu, menuT $menuT, Page $page)
    {
        $this->moduleName = 'menus';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['positions'] = config('settings.root.menu_position');
        $this->data['attachments'] = config('settings.root.menu_attachments');
        $this->data['availablePages'] = $page->all();
        $this->menu = $menu;
        $this->menuT = $menuT;
        $this->page = $page;
        $this->request = $request;
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->menu->getList()->paginate(self::PAG_NUM);

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
        $this->data['parentID'] = $parentID;

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->validate($this->request, ['redirect' => 'required_without:concrete_attachment']);
        $this->menu->create($this->data() + [
                'sort' => $this->menu->getMaxSort()+1,
                'parent_id' => $this->request->parentID,
                'redirect' => $this->request->redirect,
                'attachment' => $this->request->attachment,
                'attachment_id' => $this->request->concrete_attachment
            ]);

        return redirect()->route('backend.menus.index', ['locale' => $locale]);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, $id)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->menu->find($id) ?: abort(404);

        return view($this->templateName, $this->data);
    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'visible' => $this->request->visible || 0,
            'position' => $this->request->position,
        ];
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $this->menu->find($id)->update($this->data());

        return redirect()->back()->with('updated', 'menu updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $menuChildren = $this->menu->getChildren($id);
        if ($menuChildren->get()){
            $menuChildren->delete();
        }

        $this->menu->find($id)->delete();

        return response('menu with children deleted successfully', '200');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trans($locale, $id)
    {
        $this->templateName .= 'content_edit';
        $this->data['item'] = $this->menu->find($id) ?: abort(404);
        $this->data['itemContent'] = $this->menuT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->request->validate(['title' => 'required|min:2|max:100']);
        $itemContent = $this->menuT->getItem($locale, $id);
        $requests = ['title' => $this->request->title];

        $itemContent ? $itemContent->update($requests) : $this->menuT->create($requests + ['menu_id' => $id, 'lang_slug' => $locale]);

        return redirect()->back()->with('saved', 'menu title saved successfully!');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inside($locale, $id)
    {
        $this->templateName .= 'inside.wrapper';
        $this->data['items'] = $this->menu->where('parent_id', $id)->getList()->paginate(self::PAG_NUM);
        $this->data['item'] = $this->menu->find($id);
        $this->data['itemContent'] = $this->menuT->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->menu->find($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
