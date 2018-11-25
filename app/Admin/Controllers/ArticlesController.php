<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponCode;

use App\Models\Feedback;
use App\Models\Store\Categories;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticlesController extends Controller
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
            $content->header('文章列表');
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
        return Admin::grid(Article::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->user_id('用户id');
            $grid->category('分类')->display(function ($value) {
                return $value ? $value['name'] : '';
            });
            $grid->title('标题')->style('max-width:200px;word-break:break-all;');;
//            $grid->summary('概览');
            $grid->cover('封面图')->display(function ($cover){
                return '<img src="'.config('filesystems.disks.admin.url').'/'.$cover.'" width="50px"/>';
            });
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
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
            $content->header('编辑文章');
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
            $content->header('新增文章');
            $content->body($this->form());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {
            $categories = Category::getByAlias([
                'news',
                'about',
                'headlines',
                'terms'
            ]);
            $categoriesMap = array();
            foreach($categories as $k => $category){
                $categoriesMap[$category->id] = $category->name;
            }
            $form->display('id', 'ID');
            $form->select('category_id', '文章分类')->options($categoriesMap)->rules('required');
            $form->text('title', '标题')->rules('required');
            $form->image('cover', '封面图')->uniqueName();

            $form->editor('content', '内容');
            $form->saving(function (Form $form) {
                $form->image = config('filesystems.disks.admin.url').'/'.$form->image;
            });
        });
    }
}
