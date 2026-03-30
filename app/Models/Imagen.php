<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
   protected $fillable = ['chat_id', 'ruta'];

public function chat()
{
    return $this->belongsTo(Chat::class);
}
}
