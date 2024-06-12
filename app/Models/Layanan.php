<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'identifier', 'thumbnail', 'description', 'note', 'qty', 'price'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('identifier', $kategori);
            });
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class,  'category_id', 'id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'id', 'layanan_id');
    }
}
