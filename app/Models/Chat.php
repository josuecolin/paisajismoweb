<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['prompt'];

public function imagenes()
{
    return $this->hasMany(Imagen::class);
}
}
