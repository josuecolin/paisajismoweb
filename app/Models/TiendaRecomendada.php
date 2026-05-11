<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TiendaRecomendada extends Model
{
    protected $table = 'tiendas_recomendadas';

    protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
        'icono',
        'color',
        'sitio_web',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // ── Relaciones ──────────────────────────────────────────────────────────

    /**
     * Categorías a las que pertenece esta tienda.
     * Se especifican explícitamente los nombres de columnas de la pivot
     * para que Laravel no los infiera mal desde el nombre del modelo.
     */
    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(
            Categoria::class,       // Modelo relacionado
            'categoria_tienda',     // Nombre de la tabla pivot
            'tienda_id',            // FK de esta clase en la pivot
            'categoria_id'          // FK del modelo relacionado en la pivot
        );
    }

    /** Tags de la tienda */
    public function tags(): HasMany
    {
        return $this->hasMany(TiendaTag::class, 'tienda_id');
    }

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    public function scopePorCategoria($query, string $slug)
    {
        return $query->whereHas('categorias', fn ($q) => $q->where('slug', $slug));
    }
}