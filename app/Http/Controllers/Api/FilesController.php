<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\Api\FileRequest;
use App\Models\File;
use App\Transformers\FileTransformer;

class FilesController extends Controller
{
    public function store(FileRequest $request, FileUploadHandler $uploader)
    {
        $user = $this->user();
        $result = $uploader->save($request->file, str_plural($request->type), $user->id);
        $file = new File();
        $file->path = $result['path'];
        $file->type = $request->type;
        $file->user_id = $user->id;
        $file->save();

        return $this->response->item($file, new FileTransformer())->setStatusCode(201);
    }
}
