<?php

return [
	'dateformat' => ENV('LIVEPOS_DATEFORMAT', 'dd-mm-yyyy'),
	'phpdateformat' => ENV('LIVEPOS_PHPDATEFORMAT', 'd-m-Y'),
    'subfolder' => ENV('LIVEPOS_SUBFOLDER', ''),
    'useremail' => ENV('LIVEPOS_USEREMAIL', true),
    'frontend' => ENV('LIVEPOS_FRONTEND', false),
    'salt' => ENV('LIVEPOS_SALT', '##SALT##__password__##SALT##'), //this_just_example_salt__password__to_make_strong    
    'theme' => ENV('LIVEPOS_THEME', 'AdminLTE'),
    'company' => ENV('LIVEPOS_COMPANY', 'PT Hiret Web Indonesia'),
    'title' => ENV('LIVEPOS_TITLE', 'live <b>POS</b> App'),
    'shorttitle' => ENV('LIVEPOS_SHORTTITLE', 'l<b>P</b>A'),
    
    'model' => [
	    'product' => [
		    'attributes' => [
		        'name' => 'Nama Produk',
		        'category_id' => 'Kategori',
		        'brand_id' => 'Merk',
		        'unit' => 'Satuan',
		        'purchase_price' => 'Harga Beli',
		        'selling_price' => 'Harga Jual'
		    ],

		    'init_data' => [
		        'name' => '', 
		        'category_id' => '', 
		        'brand_id' => '', 
		        'min_stock' => '0', 
		        'init_stock' => '0', 
		        'purchase_price' => '0', 
		        'selling_price' => '0', 
		        'active' => '1', 
		        'unit' => 'pcs'
		    ], 
	    ],
    ],
];