<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Translations\Menu as menuT;

class MenuController extends BaseController
{
    /**
     * MenuController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'menus';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['positions'] = config('settings.root.menu_position');
        $this->data['attachments'] = config('settings.root.menu_attachments');
        $this->request = $request;
        $this->setModel(new Menu());
    }

    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->model->getList()->paginate(self::PAG_NUM);

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
        $this->model->create($this->data() + [
                'sort' => $this->model->getSort(),
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
        $this->data['item'] = $this->model->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'visible' => $this->request->visible,
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
        $this->model->findOrFail($id)->update($this->data());

        return redirect()->back()->with('updated', 'menu updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $menuChildren = $this->model->getChildren($id);
        if ($menuChildren->get()){
            $menuChildren->delete();
        }

        $this->model->findOrFail($id)->delete();

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
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['itemContent'] = (new MenuT)->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transAction($locale, $id)
    {
        $this->setModel(new menuT());
        $this->request->validate(['title' => 'required|min:2|max:100']);
        $itemContent = $this->model->getItem($locale, $id);
        $requests = ['title' => $this->request->title];

        $itemContent ? $itemContent->update($requests) : $this->model->create($requests + ['menu_id' => $id, 'lang_slug' => $locale]);

        return redirect()->back()->with('updated', 'menu title saved successfully!');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inside($locale, $id)
    {
        $this->templateName .= 'inside.wrapper';
        $this->data['items'] = $this->model->where('parent_id', $id)->getList()->paginate(self::PAG_NUM);
        $this->data['item'] = $this->model->findOrFail($id);
        $this->data['itemContent'] = (new MenuT)->getItem($locale, $id);

        return view($this->templateName, $this->data);
    }
}
