<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $language;

    /**
     * LanguageController constructor.
     * @param Request $request
     * @param Language $language
     */
    public function __construct(Request $request, Language $language)
    {
        $this->moduleName = 'languages';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
        $this->request = $request;
        $this->language = $language;
    }

    public function index()
    {
        // empty, does not exist!
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($locale)
    {
        $this->request->validate(['country' => 'required|unique:languages|max:255', 'lang' => 'required|unique:languages|max:2|min:2']);

        $this->language->create($this->request->all());
        return redirect()->back()->with('created', 'Language created successfully');
    }

    /** Called when changing language by switcher!
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang($locale)
    {
        return redirect()->to(substr_replace(url()->previous(), $locale, strlen($this->request->root())+strlen('/manage/'), strlen($locale)));
    }
}
