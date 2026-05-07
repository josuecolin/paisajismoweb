<?php
 
/* ============================================================
   MODELO: app/Models/Post.php
   ============================================================ */
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Post extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'user_id',
    ];
 
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
    /**
     * Usuario autor del post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    /**
     * Categorías del post (many-to-many)
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_post');
    }
}
