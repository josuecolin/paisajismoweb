<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TiendaTag extends Model
{
    public $timestamps = false;

    protected $table = 'tienda_tags';

    protected $fillable = ['tienda_id', 'tag'];

    public function tienda(): BelongsTo
    {
        return $this->belongsTo(TiendaRecomendada::class, 'tienda_id');
    }
}
