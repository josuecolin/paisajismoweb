<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectItem extends Model
{
    protected $fillable = ['project_id', 'material_id', 'quantity', 'unit_price', 'notes'];

    protected $casts = ['quantity' => 'decimal:2', 'unit_price' => 'decimal:2'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function getTotalAttribute(): float
    {
        return round((float) $this->quantity * (float) $this->unit_price, 2);
    }
}
