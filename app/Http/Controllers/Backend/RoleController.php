<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Libs\Date;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    private $allowedModules;
    private $role;

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
        $this->data['item'] = $this->role->findOrFail($id);

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, $id)
    {
        $item = $this->role->findOrFail($id);
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
        $this->role->findOrFail($id)->delete();

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
