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

        $data = $this->model;

        foreach ($filters as $column => $value) {
            $op = $searchableColumns[$column];
            $value = is_null($value) ? '' : $value;

            $data->where($column, $op, $value);
        }

        return $this->formatData($data->paginate(config('custom.datagrid.page_size')));
    }

    private function formatData($paginatedData)
    {
        if (!$paginatedData->getCollection()->count()) {
            return $paginatedData;
        }

        $fields = array_keys($paginatedData->getCollection()->first()->toArray());
        
        $paginatedData->getCollection()->transform(function ($data) use ($fields) {
            return $this->applyModifiers($data, $fields);
        });

        return $paginatedData;
    }

    private function applyModifiers($data, array $fields)
    {
        foreach ($fields as $field) {
            $listModifier = $this->convertAttributeToMethod($field);

            if (method_exists($this->model, $listModifier)) {
                $data->$field = call_user_func_array(array($this->model, $listModifier), array($data->$field));
            }
        }

        return $data;
    }

    private function convertAttributeToMethod($attr)
    {
        $names = explode('_', $attr);
        
        array_walk($names, function (&$name) {
            $name = ucfirst($name); 
        });
        
        $method = 'get' . implode('', $names) . 'List';
        
        return $method;
    }
}