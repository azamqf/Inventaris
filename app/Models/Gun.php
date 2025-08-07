<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gun extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'serial_number', 'gun_type_id'];

    public function gunType(): BelongsTo
    {
        return $this->belongsTo(GunType::class);
    }
}
