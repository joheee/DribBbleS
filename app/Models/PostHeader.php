<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHeader extends Model
{
    use HasFactory;
    protected $fillable = ['UserID','PostID'];
    public $timestamps = false;
    public function users(){
        return $this->hasMany(User::class,'id','UserID');
    }
    public function posts(){
        return $this->hasMany(Post::class,'id','PostID');
    }
}
