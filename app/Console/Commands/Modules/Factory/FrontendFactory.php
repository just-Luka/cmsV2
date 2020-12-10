<?php


namespace App\Console\Commands\Modules\Factory;


use App\Console\Commands\Modules\Controllers\BaseController;
use App\Console\Commands\Modules\Controllers\FrontendController;
use App\Console\Commands\Modules\Views\BaseView;
use App\Console\Commands\Modules\Views\FrontendView;

class FrontendFactory implements IFactory
{
    /**
     * @param $moduleName
     * @return FrontendController
     * @Override
     */
    public function makeController($moduleName): BaseController
    {
        return new FrontendController($moduleName);
    }

    /**
     * @param $moduleName
     * @return BaseView
     * @Override
     */
    public function makeView($moduleName): BaseView
    {
        return new FrontendView($moduleName);
    }
}
