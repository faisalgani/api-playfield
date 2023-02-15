<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_room_schedule extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "room_schedule";
	protected $fillable = [
        'id',
        'room_id',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

}
