<?php

namespace App\Models;

use App\Http\Requests\GaleriRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'thumbnail'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('identifier', 'like', '%' . $kategori . '%');
            });
        });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLayanan::class,  'category_id', 'id');
    }
}
