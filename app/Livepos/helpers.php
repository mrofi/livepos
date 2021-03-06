<?php

function livepos_arrayMapRecursive($callback, $array) 
{
    foreach ($array as $key => $value) {
        if (is_array($array[$key])) {
            $array[$key] = livepos_arrayMapRecursive($callback, $array[$key]);
        }
        else {
            $array[$key] = call_user_func($callback, $array[$key]);
        }
    }
    return $array;
}

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
    return $date->format(config('livepos.phpdatetimeformat'));
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

function livepos_round($value, $decimal = ',')
{
    $value = livepos_isRound($value) ? floor($value) : (!is_numeric($value) ? $value : floatval($value));   
    return preg_replace('/\./', $decimal, $value); 
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

function livepos_alphaToNumber($dest)
{
    if ($dest)
        return ord(strtolower($dest)) - 96;
    else
        return 0;
}

function livepos_toCurrency($num, $str = 'Rp. ')
{
    $num = intval(preg_replace('/,.*|[^0-9]/', '', ceil($num)));
    return $str.strrev(implode('.',str_split(strrev(strval($num)),3)));
}

function livepos_activeMenu($page, $thePage)
{
    if ($page == $thePage) return 'active';
}