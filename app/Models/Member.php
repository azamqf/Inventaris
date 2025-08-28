<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Member extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'nrp',
        'phone',
        'gender',
        'rank_id',
        'user_id',
        'status', // ✅ tambahin kalau ada kolom status di DB
    ];

    /**
     * Relasi ke tabel Rank
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    /**
     * Relasi ke tabel User (Kesatuan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ✅ Definisikan koleksi media untuk avatar
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->singleFile(); // hanya simpan 1 foto per member
    }

    /**
     * ✅ Konversi media otomatis (misal thumbnail untuk list/table)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10)
            ->nonQueued(); // langsung diproses (tidak pakai queue)
    }
}
