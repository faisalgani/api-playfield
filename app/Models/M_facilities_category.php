<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_facilities_category extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "facilities_category";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'category',
        'order',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function category_to_facilities(){
		return $this->hasMany('App\Models\M_facilities','category_id', 'id');
	}
}
