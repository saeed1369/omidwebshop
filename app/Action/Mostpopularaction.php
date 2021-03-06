<?php

namespace App\Action;

use TCG\Voyager\Actions\AbstractAction;

class Mostpopularaction extends AbstractAction
{
    public function getTitle()
    {
        return 'محبوب ترین';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return url('admin/addtomostpopular', $this->data->{$this->data->getKeyName()});
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'products';
    }
}
