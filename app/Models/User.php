<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'questionnaire_completed_at',
    'cluster_ml',
    'perfil_ml',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'questionnaire_completed_at' => 'datetime',
        'password' => 'hashed',
    ];
}

        public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function categoriasPreferidas()
   {
       return $this->belongsToMany(\App\Models\Categoria::class, 'categoria_user');
   }

    public function postsGuardados()
    {
        return $this->belongsToMany(Post::class, 'post_guardados')
                    ->withTimestamps();
    }

    public function preferences()
{
    return $this->hasOne(UserPreference::class);
}

public function projects()
{
    return $this->hasMany(\App\Models\Project::class);
}

    
}
