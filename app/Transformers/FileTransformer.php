<?php

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    public function transform(File $file)
    {
        return [
            'id' => $file->id,
            'user_id' => $file->user_id,
            'type' => $file->type,
            'path' => $file->path,
            'created_at' => $file->created_at->toDateTimeString(),
            'updated_at' => $file->updated_at->toDateTimeString(),
        ];
    }
}
