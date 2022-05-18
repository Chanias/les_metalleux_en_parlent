<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // récupérer automatiquement les commentaires associés
    //protected $with = ['commentaires', 'user'];

    protected $fillable=[
        'user_id',
        'content',
        'tags',
        'image'
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentaires(){
        return $this->hasMany(Commentaire::class);
    }
}
