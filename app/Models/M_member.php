<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_member extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "member";
	protected $fillable = [
        'id',
        'member_code',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'address',
        'profile_picture',
        'id_business_index',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];
}
