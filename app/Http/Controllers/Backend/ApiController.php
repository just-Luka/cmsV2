<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;

class ApiController extends BaseController
{
    private $modelPath = 'App\\Models\\';

    /**
     * @return \Illuminate\Http\Response|mixed
     */
    private function model()
    {
        $model = $this->modelPath .= $this->data['model'];

        return class_exists($model) ? new $model : response('Model not found!');
    }

    /** That use javascript to make able select multiple category, tags ... other items selection!
     * @param $locale
     * @param $modelName
     * @return mixed
     */
    public function getAttachment($locale, $modelName)
    {
        $this->data['model'] = Str::singular(ucfirst($modelName));

        return $this->model()->with('translation')->get();
    }
}
