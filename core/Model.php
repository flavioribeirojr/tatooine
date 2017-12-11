<?php

namespace Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $filterColumns = [];

    public function getFilterColumns()
    {
        return $this->filterColumns;
    }
}