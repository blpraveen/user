<?php

namespace App\Models;
use Cache;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	protected $fillable = ['dish_id', 'sub_total','tax','discount','total','quantity','user_id'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
        'updated_at' => 'datetime:d-M-Y'
    ];

    public function dish()
    {       
		return $this->hasOne('App\Models\Dish', 'id', 'dish_id');
    } 
}
