<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\Api\FileRequest;
use App\Http\Requests\Request;
use App\Models\Facility;
use App\Models\File;
use App\Transformers\FacilityTransformer;
use App\Transformers\FileTransformer;

class FacilitiesController extends Controller
{
    public function index(Request $request)
    {
        $facilities = Facility::query()->where("disabled", 0)->get();

        return $this->response->collection($facilities, new FacilityTransformer())->setStatusCode(201);
    }
}
