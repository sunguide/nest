<?php

namespace App\Admin\Controllers;

use App\Models\Coupon;
use App\Models\CouponCode;

use App\Models\Feedback;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FeedbackController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('意见反馈列表');
            $content->body($this->grid());
        });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Feedback::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->category_id('分类id');
            $grid->user_id('用户id');
            $grid->content('内容');
            $grid->platform('平台');
            $grid->version('版本');
            $grid->contact('联系方式');
            $grid->created_at('创建时间');
        });
    }
}
