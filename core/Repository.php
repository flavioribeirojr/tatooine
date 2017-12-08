<?php

namespace Core;

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
}