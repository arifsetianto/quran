<?php

namespace App\Models;

use App\Enum\ChapterType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class Chapter extends Model
{
    use HasFactory;

    protected $casts = [
        'total_verses' => 'int',
        'start'        => 'int',
        'order'        => 'int',
        'rukus'        => 'int',
        'type'         => ChapterType::class
    ];
}
