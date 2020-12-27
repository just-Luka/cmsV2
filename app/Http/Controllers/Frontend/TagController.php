<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;

class TagController extends BaseController
{

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'tags';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Tag $tag)
    {
        $this->templateName .= 'index';
        $this->data['item'] = $tag->frontItem($slug);

        return view($this->templateName, $this->data);
    }
}
