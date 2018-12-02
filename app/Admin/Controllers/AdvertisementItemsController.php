<?php

namespace App\Admin\Controllers;

use App\Models\Advertisement\Position;
use App\Models\AdvertisementItem;
use App\Models\CouponCode;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdvertisementItemsController extends Controller
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
            $content->header('广告内容列表');
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
            $content->header('编辑广告内容');
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
            $content->header('新增广告内容');
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
        return Admin::grid(AdvertisementItem::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->position_id('广告位');
            $grid->title('广告标题');
            $grid->cover('图片')->display(function ($cover){
                return '<img src="'.config('filesystems.disks.admin.url').'/'.$cover.'" width="50px"/>';
            });
            $grid->url('链接');
            $grid->content('广告内容');
            $grid->column('start_time', '开始时间')->display(function ($value) {
                return date('Y-m-d H:i:s', $value);
            });
            $grid->column('end_time', '开始时间')->display(function ($value) {
                return date('Y-m-d H:i:s', $value);
            });
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

        return Admin::form(AdvertisementItem::class, function (Form $form) {
            $positions = Position::get();
            $positionsMap = array();
            foreach($positions as $k => $position){
                $positionsMap[$position->id] = $position->name;
            }
            $form->display('id', 'ID');
            $form->select('position_id', '广告位')->options($positionsMap)->rules('required');
            $form->text('title', '广告标题')->rules('required');
            $form->text('content', '广告正文')->rules('required');
            $form->image('cover', '广告图片')->rules('required');
            $form->text('url', '广告链接')->rules('required');
            $form->datetime('start_time', '开始时间');
            $form->datetime('end_time', '结束时间');
            $form->radio('status', '启用')->options(['1' => '是', '0' => '否']);

            $form->saving(function (Form $form) {
                if (!$form->extra) {
                    $form->extra = '{}';
                }
                if ($form->start_time) {
                    $form->start_time = strtotime($form->start_time);
                }
                if ($form->end_time) {
                    $form->end_time = strtotime($form->end_time);
                }
            });
        });
    }
}
