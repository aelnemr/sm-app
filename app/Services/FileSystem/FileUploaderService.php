<?php


namespace App\Services\FileSystem;


use App\Models\TemporaryUpload;

class FileUploaderService
{
    /**
     * @return mixed
     */
    public function upload()
    {
        $temporaryUpload = TemporaryUpload::create();
        $temporaryUpload->addMultipleMediaFromRequest(['files'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });

        return $temporaryUpload->media;
    }
}
