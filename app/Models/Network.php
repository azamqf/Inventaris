<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Network extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'serial_number',
        'network_type_id',
        'member_id',
        'condition_id',
    ];

    public function type()
    {
        return $this->belongsTo(NetworkType::class, 'network_type_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
