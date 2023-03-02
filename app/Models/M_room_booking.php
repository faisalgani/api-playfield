<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_room_booking extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "room_booking";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'benefits_id',
        'member_id',
        'booking_code',
        'time_attended',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

}
