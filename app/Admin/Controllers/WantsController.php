<?php

namespace App\Admin\Controllers;

use App\Models\House;
use App\Models\Want;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class WantsController extends Controller
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
            $content->header('需求列表');
            $content->body($this->grid());
        });
    }

    /**
     * show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('查看需求');
            $content->body($this->form()->edit($id));
        });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Want::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->user_id('用户id');
            $grid->type('房屋类型')->display(function ($type) {
                return House::getTypeDesc($type);
            });
            $grid->trade('交易类型')->display(function ($trade) {
                return House::getTradeDesc($trade);
            });
            $grid->purpose('用途')->display(function ($purpose) {
                return House::getTradeDesc($purpose);
            });
            $grid->title('标题');
            $grid->budget_min('预算最低');
            $grid->budget_max('预算最高');
            $grid->created_at('发布时间');
            $grid->updated_at('更新时间');

            $grid->actions(function ($actions) {
                $actions->disableEdit();
            });
            $grid->tools(function ($tools) {
                // 禁用批量删除按钮
                $tools->batch(function ($batch) {
                });
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // 创建一个表单
        return Admin::form(Want::class, function (Form $form) {
            // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
            $form->text('title', '商品名称')->rules('required');
            // 创建一个选择图片的框
            $form->image('image', '封面图片')->rules('required|image');
            // 创建一个富文本编辑器
            $form->editor('description', '商品描述')->rules('required');
            // 创建一组单选框
            $form->radio('on_sale', '上架')->options(['1' => '是', '0' => '否'])->default('0');
            // 直接添加一对多的关联模型
            $form->hasMany('skus', function (Form\NestedForm $form) {
                $form->text('title', 'SKU 名称')->rules('required');
                $form->text('description', 'SKU 描述')->rules('required');
                $form->text('price', '单价')->rules('required|numeric|min:0.01');
                $form->text('stock', '剩余库存')->rules('required|integer|min:0');
            });
            // 定义事件回调，当模型即将保存时会触发这个回调
            $form->saving(function (Form $form) {
                $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price');
            });
        });
    }
}
