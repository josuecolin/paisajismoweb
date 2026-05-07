<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'color',
    ];
 
    /**
     * Posts que pertenecen a esta categoría (many-to-many)
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'categoria_post');
    }
 
    /**
     * Usuarios que tienen esta categoría como preferencia (many-to-many)
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'categoria_user');
    }
}