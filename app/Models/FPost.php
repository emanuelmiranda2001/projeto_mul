<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FPost extends Model
{
    protected $fillable = [
        'user_id', 'id', 'title', 'message', 'status'
    ];

    public function comments(){
        return $this->hasMany(Fpost_Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
