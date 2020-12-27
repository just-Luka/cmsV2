<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends BaseController
{
    private $allowedModules;

    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'roles';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['modules'] = config('modules.root');
        $this->request = $request;
        $this->setModel(new Role());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->model->all();

        return view($this->templateName, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
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
        $this->model->create($this->data());

        return redirect()->route('backend.roles.index', ['locale' => $locale]);
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return $this->model->getList($this->request->status);
    }

    /**
     * @param null $id
     * @return array
     */
    private function data($id=null)
    {
        $this->request->validate([
            'status' => ['required', 'min:2', 'max:255', Rule::unique('roles')->ignore($id)],
        ]);

        $modules = $this->request->except(['status', '_token']);
        foreach ($modules as $key => $value){
            $this->parseSelectedModules($key);
        }

        return [
            'status' => $this->request->status,
            'permissions' => json_encode($this->allowedModules)
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

        return redirect()->back();
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($locale, $id)
    {
        $this->model->findOrFail($id)->delete();

        return redirect()->back();
    }

    /**
     * @param String $module
     */
    private function parseSelectedModules(String $module) : void
    {
        $lenModule = strlen($module);

        $actionName = false;
        $moduleName = $action = '';
        for ($i=0; $i<$lenModule; $i++){
            if ($module[$i] === '_'){
                $actionName = true;
                continue;
            }
            if (!$actionName) {
                $moduleName .= $module[$i];
            }else {
                $action .= $module[$i];
            }
        }
        if (isset($this->allowedModules[$moduleName])){
            $this->allowedModules[$moduleName] += [$action => true];
        }else{
            $this->allowedModules[$moduleName] = [$action => true];
        }
    }

}
