<?php

namespace App\GraphQL\Mutations;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaUpload
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke($_, array $args)
    {
        // Удалено!
        return response('File uploaded',200)
            ->header('Content-Type', 'multipart/form-data');
    }

}
