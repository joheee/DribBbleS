<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function users(){
        return $this->belongsTo(User::class, 'UserID' ,'id');
    }
}
