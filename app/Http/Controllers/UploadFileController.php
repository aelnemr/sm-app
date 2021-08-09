<?php

namespace App\Http\Controllers;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Services\FileSystem\FileUploaderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadFileController extends Controller
{
    use CoreJsonResponse;

    /**
     * @var FileUploaderService
     */
    private $fileUploader;

    /**
     * UploadFileController constructor.
     * @param FileUploaderService $fileUploader
     */
    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function upload(): JsonResponse
    {
        return $this->ok($this->fileUploader->upload()->toArray());
    }
}
