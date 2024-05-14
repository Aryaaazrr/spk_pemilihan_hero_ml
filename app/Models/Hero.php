<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;
    protected $table = 'hero';
    protected $primaryKey = 'id_hero';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function detail_hero()
    {
        return $this->hasMany(DetailHero::class, 'id_hero', 'id_hero');
    }

    public function alternatif()
    {
        return $this->hasOne(Alternatif::class, 'id_hero', 'id_hero');
    }
}