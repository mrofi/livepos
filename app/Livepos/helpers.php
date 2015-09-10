<?php

function livepos_password($password = null)
{
    $salt = config('livepos.salt');
    if ($password == null) $password = str_random(5);
    
    return sha1(str_replace('__password__', $password, $salt));
}

function livepos_theme($theme = null)
{
    if ($theme == null) return config('livepos.theme');
    
    config(['livepos.theme' => $theme]);
}

function livepos_getThemeView($file = 'template')
{
    $theme = config('livepos.theme');
    return "themes.{$theme}.{$file}";
}

function livepos_asset($location = '')
{
    $location = (('' == $s = config('livepos.subfolder')) ? '' : '/'.$s).'/'.$location;
    // return (Request::secure()) ? secure_asset($location) : asset($location);

    return $location;
}

function livepos_themeAsset($location = '')
{
    $subfolder = ('' == $s = config('livepos.subfolder')) ? '' : $s.'/';
    $location =  '/'.$subfolder.'themes/'.config('livepos.theme').'/'.$location;
    // return (Request::secure()) ? secure_asset($location) : asset($location);

    return $location;
}