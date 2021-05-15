<?php

namespace App\Models;
use Cache;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
	protected $table = 'dishes';

	protected $fillable = ['dish_name', 'available','price'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
        'updated_at' => 'datetime:d-M-Y'
    ];

}
