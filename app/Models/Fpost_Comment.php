<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fpost_Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'f_post_id', 'user_id','comment'
    ];

    public function fpost()
    {
        return $this->belongsTo(FPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
