<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_facilities extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "facilities";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'category_id',
        'name',
        'location',
        'description',
        'image',
        'video',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];
}
