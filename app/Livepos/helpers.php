<?php

function livepos_password($password = null)
{
    $salt = config('livepos.salt');
    if ($password == null) $password = str_random(5);
    
    return sha1(str_replace('__password__', $password, $salt));
}

function livepos_dateToShow($date = null)
{
    if ($date == null) $date = \Carbon::now()->format('Y-m-d');
    $date = \Carbon::createFromFormat('Y-m-d', $date);
    return $date->format(config('livepos.phpdateformat'));
}

function livepos_dateTimeToShow($date)
{
    $date = \Carbon::createFromFormat('Y-m-d H:i:s', $date);
    return $date->format(config('livepos.phpdateformat'));
}

function livepos_dateToDB($date)
{
    $date = \Carbon::createFromFormat(config('livepos.phpdateformat'), $date);
    return $date->toDateString();
}

function livepos_dateTimeToDB($date)
{
    $date = \Carbon::createFromFormat(config('livepos.phpdateformat'), $date);
    return $date->toDateTimeString();
}

function livepos_isRound($value)
{
    if (!is_numeric($value)) return false;
    return floor($value) == $value;
}

function livepos_round($value)
{
    return livepos_isRound($value) ? floor($value) : $value;    
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