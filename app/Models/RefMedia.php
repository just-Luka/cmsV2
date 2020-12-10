<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefMedia extends Model
{
    protected $table = 'ref_media';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @param $file
     * @param $moduleName
     * @param $referenceID
     * @param false $edit
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function makeConnection($file, $moduleName, $referenceID, $edit = false)
    {
        if (!$file) {
            return false;
        }

        $media = new Media();
        $fileData = $media->createMediaData($file);
        $mediaFile = $media->where('full_src', $fileData['full_src'])->first();

        if (!$mediaFile) {
            $storedFile = $media->create($fileData);
            $mediaID = $storedFile->id;
        } else {
            $mediaID = $mediaFile->id;
        }

        if ($edit) {
            $findMediaRef = $this->getList($moduleName, $referenceID)->first();
            if ($findMediaRef) {
                $findMediaRef->media_id = $mediaID;
                $findMediaRef->save();

                return response('file updated successfully', 200);
            }
        }

        $this->create([
            'media_id' => $mediaID,
            'reference_module' => $moduleName,
            'reference_id' => $referenceID
        ]);

        return response('file created successfully', 200);
    }

    /**
     * @param null $referenceModule
     * @param null $referenceID
     * @return mixed
     */
    public function getList($referenceModule=null, $referenceID=null)
    {
        return $this->where('reference_module', $referenceModule ?? 'like', '%')->where('reference_id', $referenceID ?? 'like', '%');
    }

}
