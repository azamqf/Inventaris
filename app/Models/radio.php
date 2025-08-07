<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Radio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['serial_number', 'radio_type_id', 'member_id', 'condition_id'];

    public function radioType()
    {
        return $this->belongsTo(RadioType::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Optional: jika ingin menentukan nama collection default secara eksplisit
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('radios')->singleFile();
    }

    public function  condition()
    {
        return $this->belongsTo(condition::class);
    }
}
