<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\Api\FeedbackRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Transformers\FeedbackTransformer;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class FeedbacksController extends Controller
{
    public function index(Feedback $feedback)
    {
        $feedbacks = $feedback->paginate(10);

        return $this->response->paginator($feedbacks, new FeedbackTransformer());    }

    public function store(FeedbackRequest $feedbackRequest, Feedback $feedback)
    {
        $feedback->fill($feedbackRequest->all());
        $feedback->save();
        return $this->response->item($feedback, new FeedbackTransformer());
    }
}
