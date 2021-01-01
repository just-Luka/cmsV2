<?php

namespace App\Models;

use App\Facades\FileLib;
use Illuminate\Support\Facades\Auth;

class Media extends BaseModel
{

    protected $guarded = [];


    /** TODO rewrite
     * @param $fileName
     * @return array
     */
    public function createMediaData(String $fileName)
    {
        $fileData = FileLib::getImage($fileName);
        $extensionType = $fileData['extension'];

        $fileTypes = config('settings.root.file_types');

        if (in_array($extensionType, $fileTypes['images'])) {
            $type = 'image';
        }
        elseif (in_array($extensionType, $fileTypes['docs'])) {
            $type = 'document';
        }
        elseif (in_array($extensionType, $fileTypes['audios'])) {
            $type = 'audio';
        }
        elseif (in_array($extensionType, $fileTypes['videos'])) {
            $type = 'video';
        }
        elseif (in_array($extensionType, $fileTypes['compress'])) {
            $type = 'compressed';
        }
        elseif (in_array($extensionType, $fileTypes['data'])) {
            $type = 'data';
        }
        else {
            $type = 'other';
        }

        return [
            'src' => $fileData['src'],
            'full_src' => $fileData['full_src'],
            'type' => $type,
            'url' => $fileName,
            'extension' => $extensionType,
            'user_id' => Auth::id()
        ];
    }

    /**
     * @param null $fileType
     * @param string $sortById
     * @return mixed
     */
    public function getList($fileType=null, $sortById='asc')
    {

        return $this->where('type', $fileType ?? 'LIKE', '%')->orderBy('id', $sortById);
    }

    /**
     * @param $refMediaCollections
     * @return \Illuminate\Support\Collection
     */
    public function getViaRefList($refMediaCollections)
    {
        $files = collect();

        foreach ($refMediaCollections as $item) {
            $file = $this->find($item->media_id);
            $files->push($file);
        }

        return $files;
    }

    /**
     * @param $moduleName
     * @param $pageID
     * @return \Illuminate\Support\Collection
     */
    public function getMediaByRef($moduleName, $pageID)
    {
        $refMedia = new RefMedia();
        $references = $refMedia->getList($moduleName, $pageID)->get();

        return $this->getViaRefList($references);
    }
}
