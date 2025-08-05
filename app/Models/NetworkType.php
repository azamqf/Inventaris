<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NetworkType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function networks()
    {
        return $this->hasMany(Network::class);
    }
}
