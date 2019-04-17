<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function delete($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->markAsRead();
            return redirect($notification->data['link']);
        }
        else{
            return back()->withErrors('we could not found the specified notification');
        }
    }

}
