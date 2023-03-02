<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_event extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "event";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'event_date',
        'contact_number',
        'location',
        'capacity',
        'price',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

    function event_to_gallery(){
		return $this->hasMany('App\Models\M_event_gallery','event_id', 'id');
	}
}
