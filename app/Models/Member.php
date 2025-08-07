<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Member extends Model implements HasMedia

{
    use SoftDeletes,HasFactory, InteractsWithMedia;

    protected $table = 'members';

    protected $fillable = [
        'name',
        'nrp',
        'phone',
        'gender',
        'thumbnail',
        'rank_id',
        'user_id',
    ];

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Register Media
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}