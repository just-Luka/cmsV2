<?php

namespace App\GraphQL\Queries;

use App\Models\Translation;
use Illuminate\Support\Facades\DB;

class TranslationTrans
{

    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return mixed
     */
    public function __invoke($_, array $args)
    {
        $translation = new Translation();

        return $translation->where('key', 'LIKE', '%'.$args['word'].'%')->get();
    }
}
