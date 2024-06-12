<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'identifier'
    ];


    public function subLayanans()
    {
        return $this->hasMany(Layanan::class, 'id', 'category_id');
    }

    public function subGaleris()
    {
        return $this->hasMany(Galeri::class, 'id', 'category_id');
    }
}
