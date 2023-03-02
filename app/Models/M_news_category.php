<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_news_category extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "news_category";
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

    function category_to_news(){
		return $this->hasMany('App\Models\M_news','category_id', 'id');
	}
}
