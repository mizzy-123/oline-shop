<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_wa',
        'message',
        'status'
    ];
}
