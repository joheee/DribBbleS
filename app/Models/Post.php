<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['PostTitle','PostImage','PostDesc'];

    public function postViews(){
        return $this->hasMany(PostView::class,'PostID','id');
    }
    public function postLikes(){
        return $this->hasMany(PostLike::class,'PostID','id');
    }
    public function postHeaders(){
        return $this->belongsTo(PostHeader::class,'id','PostID');
    }
    public function postTags(){
        return $this->hasMany(PostTag::class,'PostID','id');
    }
}
