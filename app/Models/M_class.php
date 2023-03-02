<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_class extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "class";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'category_id',
        'class_type',
        'class_name',
        'start_time',
        'end_time',
        'description',
        'cover_image',
        'capacity',
        'location',
        'phone_number',
        'keyword',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function class_to_gallery(){
		return $this->hasMany('App\Models\M_class_gallery','class_id', 'id');
	}
}
