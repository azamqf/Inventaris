<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'device_type_id',
        'serial_number',
        'condition_id',
        'member_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
