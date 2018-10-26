<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    public function data($data){
        return $data;
    }
}
