<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_room extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "room";
	protected $fillable = [
        'id',
        'room_name',
        'location',
        'cover_image',
        'description',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function room_to_gallery(){
		return $this->hasMany('App\Models\M_room_gallery','id', 'room_id');
	}
}
