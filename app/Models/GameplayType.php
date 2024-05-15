<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameplayType extends Model
{
    use HasFactory;
    protected $table = 'gameplay_type';
    protected $primaryKey = 'id_gameplay';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
