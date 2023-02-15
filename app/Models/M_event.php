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
	protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'event_date',
        'location',
        'capacity',
        'price',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];
}
