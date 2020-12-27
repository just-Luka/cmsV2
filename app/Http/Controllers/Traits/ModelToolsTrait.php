<?php


namespace App\Http\Controllers\Traits;


use App\Adapter\Controllers\IController;
use App\Models\BaseModel;

trait ModelToolsTrait
{
    protected $model;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel(BaseModel $model): void
    {
        $this->model = $model;
    }

    /**
     * @param $locale
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function visible($locale, $id)
    {
        $item = $this->model->findOrFail($id);
        $item->visible = $this->request->action ? 1 : 0;
        $item->save();

        return response('Visible updated successfully', 200);
    }
}
