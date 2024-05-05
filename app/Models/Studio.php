<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Studio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'location', 'description', 'lat', 'lng'];

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function coaches(): HasOneOrMany
    {
        return $this->hasMany(Coach::class);
    }
}
