<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'category', 'unit', 'unit_price', 'supplier', 'active'];

    protected $casts = ['unit_price' => 'decimal:2', 'active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
