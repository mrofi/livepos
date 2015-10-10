<?php

return [
	'dateformat' => ENV('LIVEPOS_DATEFORMAT', 'dd-mm-yyyy'),
	'phpdateformat' => ENV('LIVEPOS_PHPDATEFORMAT', 'd-m-Y'),
	'phpdatetimeformat' => ENV('LIVEPOS_PHPDATETIMEFORMAT', 'd-m-Y H:i:s'),
    'subfolder' => ENV('LIVEPOS_SUBFOLDER', ''),
    'useremail' => ENV('LIVEPOS_USEREMAIL', true),
    'frontend' => ENV('LIVEPOS_FRONTEND', false),
    'salt' => ENV('LIVEPOS_SALT', '##SALT##__password__##SALT##'), //this_just_example_salt__password__to_make_strong    
    'theme' => ENV('LIVEPOS_THEME', 'AdminLTE'),
    'company' => ENV('LIVEPOS_COMPANY', 'PT Hiret Web Indonesia'),
    'companyaddress' => ENV('LIVEPOS_COMPANY_ADDRESS', 'Jl. Jendral Sudirman 146 Batang, <br>Jawa Tengah - Indonesia, 51211 '),
    'title' => ENV('LIVEPOS_TITLE', 'live <b>POS</b> App'),
    'shorttitle' => ENV('LIVEPOS_SHORTTITLE', 'l<b>P</b>A'),

    'percentToShop' => 20,  // from Profit
    'percentToCustomer' => 50,  // from customer allocation
    
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
		        'category_id' => '1', 
		        'brand_id' => '1', 
		        'min_stock' => '0', 
		        'init_stock' => '0', 
		        'purchase_price' => '0', 
		        'selling_price' => '0', 
		        'active' => '1', 
		        'unit' => 'pcs',
		        'multi_unit' => '0',
		        'multi_price' => '0',
		    ], 
	    ],
    ],
];