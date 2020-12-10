<?php

namespace App\GraphQL\Queries;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Facades\App;

class Courses
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return mixed
     */
    public function __invoke($_, array $args)
    {

        return $this->additionalData($args['take'], $args['main']);
    }

    /**
     * @param $take
     * @param $isMain
     * @return mixed
     */
    public function additionalData($take, $isMain)
    {
        $product = new Product();

        $productTransData = $product->with('translation')->where('visible', 1)->orderBy('sort');
        $productTransData = $isMain ? $productTransData->where('on_main', 1)->simplePaginate($take) :  $productTransData->simplePaginate($take);

        return $productTransData;
    }
}
