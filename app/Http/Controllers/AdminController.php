<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function deletePost($id) {
        Post::find($id)->delete();
        return redirect()->back()->with('message', 'success delete post!!');
    }

    public function activeUser($id) {
        $user = User::find($id);
        if($user->active == 1){
            $user->active = 0;
        } else {
            $user->active = 1;
        }
        $user->save();
        return redirect()->back()->with('message',$user->active == 1 ? 'success activate user!' : 'success deactivate user!');
    }
}
