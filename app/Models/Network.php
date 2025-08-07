<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'serial_number',
        'network_type_id',
        'member_id',
    ];

    /**
     * Relasi ke tipe jaringan (network_types)
     */
    public function type()
    {
        return $this->belongsTo(NetworkType::class, 'network_type_id');
    }

    /**
     * Relasi ke member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * (Opsional) Daftarkan media collection untuk avatar/foto
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('networks');
    }
}
