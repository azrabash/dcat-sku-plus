<?php

namespace Dcat\Admin\Extension\DcatSkuPlus\Http\Controllers;

use Dcat\Admin\Extension\DcatSkuPlus\Http\Repositories\SkuAttribute;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;

class SkuAttributeController extends AdminController
{
    private $attrType = [
        'checkbox' => 'successfully deletedsuccessfully deleted',
        'radio' => 'Single box',
    ];

    /**
     * Index interface.
     *
     * @param  Content  $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title('attribute list')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SkuAttribute(), function (Grid $grid) {
            $grid->model()->orderByDesc('id');
            $grid->id->sortable();
            $grid->column('attr_name', 'Attribute Name');
            $grid->column('attr_type', 'Attribute Type')
                ->using($this->attrType)
                ->label([
                    'checkbox' => 'info',
                    'radio' => 'primary'
                ]);
            $grid->column('sort', 'Sort')->help('The bigger the sort, the higher the front');
            $grid->column('attr_value', 'attribute value')->explode()->label();

            $grid->created_at;
            $grid->updated_at->sortable();

            $grid->disableViewButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('attr_name', 'Attribute Name');
                $filter->equal('attr_type', 'Attribute Type')->select($this->attrType);
            });
        });
    }

    /**
     * Edit interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title('edit properties')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SkuAttribute(), function (Form $form) {
            $form->display('id');
            $form->text('attr_name', 'Attribute Name')->required();
            $form->radio('attr_type', 'Attribute Type')->options($this->attrType)->required();
            $form->list('attr_value', 'Value');
            $form->number('sort', 'Sort')->default(0)->min(0)->max(100);

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableViewButton();
            $form->disableViewCheck();
        });
    }

    /**
     * Create interface.
     *
     * @param  Content  $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title('add attribute')
            ->body($this->form());
    }
}
