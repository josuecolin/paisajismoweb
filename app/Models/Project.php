<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'area_m2', 'status',
        'labor_percent', 'contingency_percent', 'tax_percent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProjectItem::class);
    }

    /**
     * Desglose del presupuesto:
     * materiales + mano de obra + imprevistos = base; base + IVA = total.
     */
    public function budget(): array
    {
        $materials = round($this->items->sum(fn ($i) => $i->total), 2);
        $labor = round($materials * $this->labor_percent / 100, 2);
        $contingency = round($materials * $this->contingency_percent / 100, 2);
        $base = $materials + $labor + $contingency;
        $tax = round($base * $this->tax_percent / 100, 2);

        return [
            'materials'   => $materials,
            'labor'       => $labor,
            'contingency' => $contingency,
            'tax'         => $tax,
            'total'       => round($base + $tax, 2),
        ];
    }
}
