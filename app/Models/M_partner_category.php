<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_partner_category extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "partner_category";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'category',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function category_to_partner(){
		return $this->hasMany('App\Models\M_partner','category_id', 'id');
	}

}
