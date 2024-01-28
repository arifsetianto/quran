<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class Quran extends Model
{
    use HasFactory;

    protected $casts = [
        'verse' => 'int'
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(Translation::class)
                    ->where('code', 'th');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
                    ->where('code', 'th');
    }
}
