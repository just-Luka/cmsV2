<?php

namespace App\Http\Controllers\Backend;

use App\Facades\FileLib;
use App\Http\Controllers\Backend\Controller;
use App\Models\Media;
use App\Models\RefMedia;
use App\Models\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    private $refMedia;
    private $validationArray = [
        'name'   => 'required|unique:users|max:255',
        'email' => 'required|unique:users',
        'password' => 'required|min:8',
    ];

    /**
     * UserController constructor.
     * @param Request $request
     * @param User $user
     * @param RefMedia $refMedia
     */
    public function __construct(Request $request, User $user, RefMedia $refMedia)
    {
        $this->moduleName = 'users';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->user = $user;
        $this->refMedia = $refMedia;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->templateName .= 'wrapper';

        return view($this->templateName, $this->data);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Role $role)
    {
        $this->templateName .= 'create';
        $this->data['roles'] = $role->getList();

        return view($this->templateName, $this->data);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->validate($this->request, $this->validationArray);
        $this->user->create($this->data() + [
                'password' => Hash::make($this->request->password),
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'email' => $this->request->email,
            ]);

        return redirect()->back()->with('created', 'user created successfully');
    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'name' => $this->request->name,
            'role_id' => $this->request->selectedRole,
            'image' => FileLib::fileParse($this->request->filepath)['full_src'] ?? null
        ];
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return $this->user->getListWithRoles($this->request->roleID, $this->request->order)->paginate(9);
    }

    /**
     * @param $locale
     * @param $id
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function edit($locale, $id, Role $role)
    {
        $this->templateName .= 'edit';
        $this->data['item'] = $this->user->find($id) ?: abort(404);;
        $this->data['userRole'] = $role->find($this->data['item']->role_id);
        $this->data['roles'] = $role->getList();

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
        $item = $this->user->find($id);
        $data = $this->data();

        if ($item->name !== $this->request->name){
            $this->validate($this->request, ['name' => 'required|max:255|unique:users']);
        }
        if ($this->request->has('password') && ($this->request->password !== 'noPasswordChanged')){
            $this->validate($this->request, ['password' => 'required|min:8']);
            $data['password'] = Hash::make($this->request->password);
        }

        $item->update($data);

        return redirect()->back()->with('updated', 'user updated successfully');
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->user->find($id)->delete();

        return response('User deleted successfully',200);
    }
}