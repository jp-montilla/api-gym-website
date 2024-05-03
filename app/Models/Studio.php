<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description', 'lat', 'lng'];

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }
}
