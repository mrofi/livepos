<?php

function livepos_password($password = null)
{
    $salt = config('livepos.salt');
    if ($password == null) $password = str_random(5);
    
    return bcrypt(str_replace('__password__', $password, $salt));
}
