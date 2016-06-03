<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.index', compact('user'));
    }

    public function follow($id)
    {
        $user = User::find($id);
        if ($user->isFollowed()) {
            $user->followers()->detach(auth()->user());
        } else {
            $user->followers()->attach(auth()->user());
        }
        return redirect()->back();
    }

}