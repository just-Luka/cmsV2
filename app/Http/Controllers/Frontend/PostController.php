<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'posts';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Post $post)
    {
        $this->data['item'] = $post->frontItem($slug);
        $this->templateName .= $this->data['item']->template;

        return view($this->templateName, $this->data);
    }
}
