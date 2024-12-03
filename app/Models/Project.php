<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'deadline', 'user_id']; // Campos rellenables

    // Relación con el modelo User
    public function user()
    {
        // Un proyecto pertenece a un usuario
        return $this->belongsTo(User::class); // Relación de uno a muchos
    }
}
