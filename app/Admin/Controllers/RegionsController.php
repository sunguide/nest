<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponCode;

use App\Models\Region;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class RegionsController extends Controller
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
            $content->header('地区列表');
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
            $content->header('编辑地区');
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
            $content->header('新增地区');
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
        return Admin::grid(Region::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->pid('父级名称')->display(function ($pid){
                return Region::getNameById($pid);
            });
            $grid->name('地区名称');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Region::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('pid', '父级id');
            $form->text('name', '名称')->rules('required');
            $form->saving(function (Form $form) {

            });
        });
    }
}
