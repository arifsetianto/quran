<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class Subject extends Model
{
    use HasFactory;

    protected $casts = [
        'total_verses'   => 'int',
        'chapter_verses' => 'array'
    ];
}
