<?php

/**
 * Get the default base url
 * 
 * @return string
 */
function baseUrl(string $complement = '')
{
    return config('app.base_route') . $complement;
}

function home()
{
    return url('/') . '/' . baseUrl() . '/' . config('app.home');
}