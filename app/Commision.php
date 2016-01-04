<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;
use Session;

class Commision extends Model
{
	protected $table = 'multilevel_commisions';
	
    protected $fillable = ['selling_id', 'multilevel_id', 'commision'];

    protected $rules = [
    	'selling_id' => 'require|numeric',
    	'multilevel_id' => 'require|numeric',
    ]; 

    public static function create(array $attributes = [])
    {
    	$created = parent::create($attributes);

    	$multilevel = Multilevel::find($attributes['multilevel_id']);

    	if ($multilevel->upline_id)
    	{
    		$percent_commision = Session::get('commision_of_customer', 0);
    		$rest_commision = (100 - $percent_commision) / $percent_commision * $attributes['commision'];
    		$commision = $percent_commision / 100 * $rest_commision;
    		static::create([
    			'selling_id' => $attributes['selling_id'],
                'multilevel_id' => $multilevel->upline_id,
                'commision' => $commision,
    		]);
    	}
    }
}
