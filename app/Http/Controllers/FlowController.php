<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FlowController extends Controller
{

    public function index(){
        $posts = Post::with(['postViews', 'postLikes', 'postHeaders' => ['users']])->paginate(6);
        $tags = Tag::with(['postTags'])
        ->get();
        $user = Auth::user();
        if($user != null && $user->role == 'admin'){
            $users = User::with('allPostHeaders')
            ->where('role','<>','admin')
            ->get();
            $posts = Post::with(['postViews', 'postLikes', 'postHeaders' => ['users']])->get();
            $u = 1;
            $p = 1;
            return view('admin.dashboard', compact('posts','tags','user','users','u','p'));
        }
        return view('index', compact('posts','tags','user'));
    }
}
