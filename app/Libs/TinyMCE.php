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

    /**
     * @param String $fileName
     * @param string $segment
     * @return array|bool
     */
    public function fileParse($fileName, $segment = 'storage') // You MUST not call fileParse statically, if you wanna change default $segment
    {
        if(!$fileName){
            return false;
        }
        /* TODO: REWRITE ON REGEX! СКА*/
        $lenFileName = strlen($fileName);
        $lenSegment = strlen($segment);
        $lenOrigin = strpos($fileName, $segment) + $lenSegment+1;

        $fullSrc = $extension = $src = '';
        $finished = $isExtensionHandled = false;

        while ($lenOrigin) {
            if ($lenFileName == $lenOrigin){
                $finished = true;
                $lenOrigin -= 1;
            }
            if (!$finished) {
                $fullSrc .= $fileName[$lenOrigin];
                $lenOrigin++;
            }else{
                if ($fileName[$lenOrigin] === '/')
                    break;

                if ($fileName[$lenOrigin] === '.')
                    $isExtensionHandled = true;

                if (!$isExtensionHandled)
                    $extension .= $fileName[$lenOrigin];

                $src .= $fileName[$lenOrigin];
                $lenOrigin--;
            }
        }

        return [
            'full_src' => $fullSrc, // from $segment e.x : /user_1/profile/photo1.jpg
            'extension' => strrev($extension), // e.x jpg, png ...
            'src' => strrev($src), // photo1.jpg
        ];
    }

    /**
     * @param $mediaFileData
     * @return string
     */
    public function fileToString($mediaFileData)
    {
        $string = '';
        if (!$mediaFileData){
            return $string;
        }

        foreach ($mediaFileData as $key => $mediaFile) {
            if ($key != 0) {
                $string .= '|||';
            }
            $string .= $mediaFile->url;
        }

        return $string; // e.x some.jpg|||some1.jpg|||some2.jpg
    }
}
