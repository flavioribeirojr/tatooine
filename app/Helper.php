<?php

/**
 * Get the default base url
 * 
 * @return string
 */
function baseUrl(string $complement = '')
{
    return url('/') . '/' . config('app.base_route') . $complement;
}

function home()
{

    return baseUrl() . '/' . config('app.home');
}