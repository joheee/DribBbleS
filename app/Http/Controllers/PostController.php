<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostHeader;
use App\Models\PostLike;
use App\Models\PostTag;
use App\Models\PostView;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function viewCreatePost(){
        $user = Auth::user();
        return view('user.upload', compact('user'));
    }

    public function createNewPost(Request $req){
        $validated = Validator::make($req->all(), [
            'PostImage' => 'required|image',
            'PostTitle' => 'required|min:10|unique:posts,PostTitle',
            'PostDesc' => 'required|min:20'
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $imageFile = $req->PostImage;
        $imageName = time().'.'.$imageFile->getClientOriginalExtension();
        Storage::putFileAs('public/posts/',$imageFile, $imageName);

        $post = new Post;
        $post->PostImage = $imageName;
        $post->PostTitle = $req->PostTitle;
        $post->PostDesc = $req->PostDesc;
        $post->save();

        $postHeader = new PostHeader;
        $postHeader->PostID = $post->id;
        $postHeader->UserID = Auth::id();
        $postHeader->save();

        if($req->TagName != null) {
            $tag = $req->TagName;
            $tag = str_replace('/',',',$tag);
            foreach(array_unique(explode(',',$tag)) as $buff) {
                $tags = trim($buff);
                $newTag = Tag::where('TagName', '=', $tags)->first();
                if(is_null($newTag)){
                    $tag = new Tag();
                    $tag->TagName = $tags;
                    $tag->save();
                }
                $postTag = new PostTag();
                $postTag->PostID = $post->id;
                $postTag->TagName = $tags;
                $postTag->save();
            }
        }

        return redirect()->route('index')->with('message','success create new post!');
    }

    public function showPostDetail($id){
        $user = Auth::user();


        if($user != null){
            if($user->role == 'admin') {
                return redirect()->back();
            }
            $postView = PostView::where('PostID','=',$id)->where('UserID','=',$user->id)->first();
            if($postView == null) {
                $newView = new PostView;
                $newView->UserID = Auth::id();
                $newView->PostID = $id;
                $newView->save();
            }
        }

        $post = Post::with(['postHeaders' => ['users'],'postViews' => ['users'], 'postLikes' => ['users'], 'postHeaders' => ['users'], 'postTags'])->where('id','=',$id)->first();
        $creator = $post->postHeaders->users[0];

        return view('user.postDetail', compact('user', 'post','creator'));
    }

    public function handleLikes($id) {
        if(Auth::user() == null) {
            return redirect()->route('guest.login');
        }
        $postLike = PostLike::where('PostID','=',$id)->where('UserID','=',Auth::id())->first();
        if($postLike == null) {
            $newLike = new PostLike;
            $newLike->UserID = Auth::id();
            $newLike->PostID = $id;
            $newLike->save();
        } else {
            $postLike->delete();
        }
        return redirect()->back()->with('message', $postLike == null ? 'success like a post!' : 'dislike a post!');
    }

    public function handleSearchQuery(Request $query){
        $search = $query->search;
        $posts = Post::with(['postTags','postViews', 'postLikes', 'postHeaders' => ['users']])
            ->where('PostTitle','like','%'.$search.'%')
            ->orWhere('PostDesc','like','%'.$search.'%')
            ->orWhereHas('postTags', function($q) use($search) {
                $q->where('TagName','like','%'.$search.'%');
            })
            ->orWhereHas('postHeaders.users', function($q2) use($search) {
                    $q2->where('name','like','%'.$search.'%');
            })
            ->paginate(6)->withQueryString();
        $tags = Tag::with(['postTags'])
            ->get();
        $user = Auth::user();

        if($user != null && $user->role == 'admin') {
            return redirect()->back();
        }

        return view('user.searchByInput', compact('posts','tags','user','search'));
    }

    public function handleSearchTag($TagName){
        $posts = Post::with(['postTags','postViews', 'postLikes', 'postHeaders' => ['users']])
            ->WhereHas('postTags', function($q) use($TagName) {
                $q->where('TagName','like','%'.$TagName.'%');
            })
            ->paginate(6);
        $tags = Tag::with(['postTags'])
        ->get();
        $user = Auth::user();

        if($user != null && $user->role == 'admin') {
            return redirect()->back();
        }

        return view('user.searchByTag', compact('posts','tags','user','TagName'));
    }
}
