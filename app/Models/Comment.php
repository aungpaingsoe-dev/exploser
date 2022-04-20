<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message','post_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
