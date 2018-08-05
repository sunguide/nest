<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\Api\FeedbackRequest;
use App\Http\Requests\Api\LogisticsRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Logistics;
use App\Transformers\FeedbackTransformer;
use App\Transformers\LogisticsTransformer;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class LogisticsController extends Controller
{
    public function index(Logistics $logistics)
    {
        $logisticsList = $logistics->paginate(10);

        return $this->response->paginator($logisticsList, new LogisticsTransformer());
    }

    public function store(LogisticsRequest $logisticsRequest, Logistics $logistics)
    {
        $logistics->fill($logisticsRequest->all());
        $logistics->save();
        return $this->response->item($logistics, new LogisticsTransformer());
    }

    public function show(Logistics $logistics)
    {
        return $this->response->item($logistics, new LogisticsTransformer());
    }
}
