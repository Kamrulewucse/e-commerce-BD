<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function all() {
        return view('admin.notification.all');
    }

    public function markRead() {
        Auth::user()->unreadNotifications->markAsRead();
    }
}
