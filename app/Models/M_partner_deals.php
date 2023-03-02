<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_partner_deals extends Model
{
    use HasFactory;
    protected $keyType = 'string';
	public $incrementing = false;
	protected $table    = "partner_deals";
    protected $hidden = ['created_at','updated_at','created_by','updated_by'];
	protected $fillable = [
        'id',
        'partner_id',
        'promo',
        'expired_date',
        'term',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
	];

}
