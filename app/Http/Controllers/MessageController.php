<?php
/**
 * Created by PhpStorm.
 * User: san
 * Date: 6/2/16
 * Time: 9:26 PM
 */

namespace App\Http\Controllers;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Controllers;

class MessageController extends Controller
{
    public function getMessage() {
        return view('admin.message');
    }
    
    public function getNewMessage () {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('message', compact('messages'));
    }
    
    public function postMessage(Request $request) {
        $this->validate($request, [
            'message' => 'required|max:1000',
        ]);

        $user = Auth::user();
        Message::create([
            'message' => $request['message'],
            'user_id' => $user->id,
        ]);

        return redirect()->back();
    }
}