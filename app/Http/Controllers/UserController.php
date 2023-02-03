<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function loginView(){
        return view('user.login');
    }

    public function registerView(){
        return view('user.register');
    }
    public function login(Request $req)
    {
        $validated = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validated->fails()) return redirect()->back()->withErrors($validated);

        $rememberMe = true;
        if($req->remember == null) {
            $rememberMe = false;
        }
        if($rememberMe == true) {
            Cookie::queue('last_email',$req->email, 60 * 24 * 7  );
        }
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials,$rememberMe)){
            if(Auth::user()->isActive() == 1){
                $req->session()->regenerate();
                return redirect()->intended(route('index'));
            }
            Auth::logout();
            return redirect()->back()->withErrors('this account has been banned by the admin!');
        } else {
            return redirect()->back()->withErrors("invalid credentials!");
        }
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,name',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
            'confirm_password' => 'required|min:8'
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $newUser = new User();
        $newUser->email = $request->email;
        $newUser->name = $request->username;
        $newUser->active = 1;
        $newUser->password = Hash::make($request->password);
        $newUser->picture = 'DefaultProfile.jpg';
        $newUser->website = 'empty.com';
        $newUser->role = 'user';
        $newUser->save();

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        } else {
            return redirect()->back()->withErrors("failed register new user!");
        }
    }


    public function updatePicture(Request $req)
    {
        $validated = Validator::make($req->all(),[
            'picture' => 'required|image',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $imageFile = $req->picture;
        $imageName = time().'.'.$imageFile->getClientOriginalExtension();
        Storage::putFileAs('public/profile/',$imageFile, $imageName);

        $user = User::find(Auth::id());
        $user->picture = $imageName;
        $user->save();
        return redirect()->back()->with('message', "success update user's profile!");
    }

    public function updateUserDetail(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'website' => 'required|unique:users,website',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->website = $request->website;
        $user->save();

        return redirect()->back()->with('message','success update user detail!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
