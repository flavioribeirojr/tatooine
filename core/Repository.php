<?php

namespace Core;

use Core\Model;

class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($method, $parameters)
    {
        if (!method_exists($this, $method)) {
            return call_user_func_array(array($this->model, $method), $parameters);
        }

        return call_user_func_array(array($this, $method), $parameters);
    }

    public function listModel(array $filters)
    {
        $searchableColumns = $this->model->getFilterColumns();
        $filters = array_only($filters, array_keys($searchableColumns));

        $filters = array_where($filters, function ($value) {
            return !is_null($value) || !empty($value);
        });

        $data = $this->model;
        
        foreach ($filters as $column => $value) {
            $op = $searchableColumns[$column];
            $value = $op == 'like' ? "%$value%" : $value;
            
            $data = $data->where($column, $op, $value);
        }

        return $data->paginate(config('custom.datagrid.page_size'));
    }

    public function update($modelId, $data)
    {
        return $this->find($modelId)->update($data);
    }
}