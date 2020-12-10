<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Libs\Date;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RoleController extends Controller
{
    private $allowedModules;
    private $role;
    private $rules = [
        'status' => 'required|unique:roles|max:255|min:2',
    ];
    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request, Role $role)
    {
        $this->moduleName = 'roles';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->data['modules'] = config('modules.root');
        $this->request = $request;
        $this->role = $role;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->templateName .= 'wrapper';
        $this->data['items'] = $this->role->all();

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
        $this->request->validate($this->rules);
        $this->role->create($this->data());

        return redirect()->route('backend.roles.index', ['locale' => $locale]);
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return $this->role->getList($this->request->status);
    }

    /**
     * @return array
     */
    private function data()
    {
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
        $this->data['item'] = $this->role->find($id) ?: abort(404);

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
        $item = $this->role->find($id);
        if ($item->status !== $this->request->status){
            $this->validate($this->request, $this->rules);
        }
        $item->update($this->data());

        return redirect()->back();
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($locale, $id)
    {
        $this->role->find($id)->delete();

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
