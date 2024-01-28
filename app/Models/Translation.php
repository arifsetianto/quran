<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class Translation extends Model
{
    use HasFactory;

    protected $casts = [
        'verse'    => 'int'
    ];
}
