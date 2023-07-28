<?php

namespace Dcat\Admin\Extension\DcatSkuPlus;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function title()
    {
        return 'SKU Extended Configuration';
    }

    public function form()
    {
        $this->text('sku_plus_img_upload_url', 'Image upload location')
            ->default('/admin/sku-image-upload')
            ->help('Must start with【/】')
            ->required();

        $this->text('sku_plus_img_remove_url', 'Image deletion location')
            ->default('/admin/sku-image-remove')
            ->help('Must start with【/】')
            ->required();
    }
}
