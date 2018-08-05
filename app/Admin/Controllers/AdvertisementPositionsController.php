<?php

namespace App\Admin\Controllers;

use App\Models\AdvertisementItem;
use App\Models\AdvertisementPosition;
use App\Models\CouponCode;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdvertisementPositionsController extends Controller
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
            $content->header('广告位列表');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('编辑广告位');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('新增广告位');
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(AdvertisementPosition::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->platform('平台');
            $grid->display_mode('显示模式');
            $grid->description('描述');
            $grid->remark('备注');

            $grid->status('状态')->display(function ($value) {
                return $value ? '是' : '否';
            });
            $grid->created_at('创建时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(AdvertisementPosition::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name', '名称')->rules('required');
            $form->radio('platform', '平台')->options(AdvertisementPosition::$platformMap)->rules('required');
            $form->radio('display_mode', '显示方式')->options(AdvertisementPosition::$typeMap)->rules('required');
            $form->text('description', '描述');
            $form->text('remark', '备注');
            $form->radio('status', '启用')->options(['1' => '是', '0' => '否']);

            $form->saving(function (Form $form) {
                if (!$form->extra) {
                    $form->extra = '{}';
                }
            });
        });
    }
}
