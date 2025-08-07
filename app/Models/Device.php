<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'serial_number',
        'status',
        'purchase_date',
        'warranty_expiry',
        'member_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
