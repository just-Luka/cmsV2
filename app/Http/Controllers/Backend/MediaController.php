<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class MediaController extends BaseController
{
    /**
     * MediaController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'media';
        $this->templateName = 'modules.' . $this->moduleName . '.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param String $moduleType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function base(String $moduleType)
    {
        $this->templateName .= 'wrapper';
        $this->data['type'] = $moduleType;
        $this->data['moduleName'] .= ' '.lang($moduleType);

        return view($this->templateName, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function files()
    {
        return $this->base('files');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function images()
    {
        return $this->base('images');
    }
}
