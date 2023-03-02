<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_class_category extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "class_category";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'class_category',
        'order',
        'is_private',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function category_to_class(){
		return $this->hasMany('App\Models\M_class','category_id', 'id');
	}
}
