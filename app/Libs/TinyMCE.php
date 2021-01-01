<?php

namespace App\Libs;

class TinyMCE {

    public function __construct()
    {
        // empty
    }

    /**
     * method is using on front, to explode words between enter, typed by text editor! e.x [0] => "Hello", [1] => "World!"
     * @param String $text
     * @return array|false|string[]
     */
    public function explodeBetweenEnter($text)
    {
        return preg_split('/\n|\r\n?/', $text);
    }

    /** You can also call that function statically but,
     *  if you wanna change default $segment you'd say "new getImage(...)"
     * @param $asset
     * @param string $segment
     * @return array
     */
    public function getImage($asset, $segment = 'storage'): array
    {
        $pathInfo = pathinfo($asset);
        preg_match('/(?<='.$segment.'.).*$/', $asset,$path);

        return [
            'full_src'   => $path[0] ?? null,
            'src'        => $pathInfo['basename'] ?? null,
            'extension'  => $pathInfo['extension'] ?? null,
        ];
    }
    /**
     * @param $mediaFileData
     * @return string
     */
    public function getOptimizeSrc($mediaFileData): string
    {
        $string = '';
        if (!$mediaFileData) return $string;

        foreach ($mediaFileData as $key => $mediaFile) {
            if ($key != 0) {
                $string .= '|||';
            }
            $string .= $mediaFile->url;
        }

        return $string; // e.x some.jpg|||some1.jpg|||some2.jpg
    }
}
