<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    public function postSignUp(Request $request) {

        $this->validate($request, [
            'username' => 'required|unique:users|max:24',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        $username = $request['username'];
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        Auth::login($user);
        return redirect()->route('users');
    }

    public function postSignIn(Request $request) {
        if (($request['username'] == 'admin') && ($request['password'] == 'admin')) {
            Auth::attempt(['username' => 'admin', 'password' => 'admin']);
            return redirect()->route('admin');
        }if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('/');
    }

    public function getAccount() {
        return view('account', ['user' => Auth::user()]);
    }

    public function getUserImage($filename) {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function postSaveAccount(Request $request) {
        $this->validate($request, [
            'full_name' => 'max:120',
            'site' => 'max:120',
            'bio' => 'max:120',
        ]);

        $user = Auth::user();
        $user->update($request->toArray());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $user->username . '-' . $user->id . '.jpg';
            $file->move('uploads', $filename);

        }
        return redirect()->route('profile', ['username' => auth()->user()->username]);
    }

    public function postSaveUserAccount(Request $request) {
        $this->validate($request, [
            'full_name' => 'required|max:120',
            'site' => 'max:120',
            'bio' => 'max:120',
        ]);

        $user = User::where('id', $request['user_id'])->first();
        $user->update($request->toArray());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $user->username . '-' . $user->id . '.jpg';
            $file->move('uploads', $filename);

        }

        return redirect()->route('profile', ['username' => $user->username]);
    }

    public function getUser() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user', compact('users'));
    }

    public function getDeleteUser($user_id) {
        $user = User::where('id', $user_id)->first();
        $user->delete();
        return redirect()->back();
    }

    public function getUserEdit($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.edit_user', compact('user'));
    }

    public function getFind(Request $request) {
        $users = User::where('username', 'like', '%' . $request['username'] . '%')->get();
        if ($users->count()) {
            return view('found_user', compact('users'));
        } else {
            echo "User Not Found";
        }
    }
}
