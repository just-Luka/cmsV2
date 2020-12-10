<?php


namespace App\Console\Commands\Modules\Factory;


use App\Console\Commands\Modules\Controllers\BackendController;
use App\Console\Commands\Modules\Controllers\BaseController;
use App\Console\Commands\Modules\Views\BackendView;
use App\Console\Commands\Modules\Views\BaseView;

class BackendFactory implements IFactory
{
    /**
     * @param $moduleName
     * @return BackendController
     * @Override
     */
    public function makeController($moduleName): BaseController
    {
        return new BackendController($moduleName);
    }

    /**
     * @param $moduleName
     * @return BaseView
     * @Override
     */
    public function makeView($moduleName): BaseView
    {
        return new BackendView($moduleName);
    }
}
