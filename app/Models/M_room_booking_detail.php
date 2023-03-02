<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_room_booking_detail extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "room_booking_detail";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'booked_id',
        'room_schedule_id',
        'time_booked',
        'date_booked',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

}
