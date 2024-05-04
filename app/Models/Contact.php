<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['mobile_number', 'email'];

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }
}
