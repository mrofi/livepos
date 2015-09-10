<?php

return [
    'subfolder' => ENV('LIVEPOS_SUBFOLDER', ''),
    'useremail' => ENV('LIVEPOS_USEREMAIL', true),
    'frontend' => ENV('LIVEPOS_FRONTEND', false),
    'salt' => ENV('LIVEPOS_SALT', '##SALT##__password__##SALT##'), //this_just_example_salt__password__to_make_strong    
    'theme' => ENV('LIVEPOS_THEME', 'AdminLTE'),
    'company' => ENV('LIVEPOS_COMPANY', 'PT Hiret Web Indonesia'),
    'title' => ENV('LIVEPOS_TITLE', 'live <b>POS</b> App'),
    'shorttitle' => ENV('LIVEPOS_SHORTTITLE', 'l<b>P</b>A')
];