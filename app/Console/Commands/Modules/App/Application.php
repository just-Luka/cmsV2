<?php


namespace App\Console\Commands\Modules\App;


use App\Console\Commands\Modules\Factory\IFactory;

class Application
{
    private $moduleName;
    private $BaseController;
    private $BaseView;

    /**
     * Application constructor.
     * @param IFactory $factory
     * @param $moduleName
     */
    public function __construct(IFactory $factory, $moduleName)
    {
        $this->BaseController = $factory; //makeController
        $this->BaseView = $factory; //makeView
        $this->moduleName = $moduleName;
    }

    /**
     * @param $factory
     */
    public function setFactory($factory): void
    {
        $this->BaseController = $factory;
        $this->BaseView = $factory;
    }

    /**
     * @return IFactory
     */
    public function getBaseController(): IFactory
    {
        return $this->BaseController;
    }

    /**
     * @return IFactory
     */
    public function getBaseView(): IFactory
    {
        return $this->BaseView;
    }

    /**
     * @return \App\Console\Commands\Modules\Controllers\BaseController
     */
    public function createController()
    {
        return $this->getBaseController()->makeController($this->moduleName);
    }

    /**
     * @return \App\Console\Commands\Modules\Views\BaseView
     */
    public function createView()
    {
        return $this->getBaseView()->makeView($this->moduleName);
    }
}
