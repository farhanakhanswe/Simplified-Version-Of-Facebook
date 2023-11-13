<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SendFriendRequestController extends Controller
{
    public function sendFriendRequest(User $user)
    {
        $authenticatedUser = Auth::user();
        $potentialFriend = $user;

        $friendRequest = new FriendRequest();
        $friendRequest->sender_id = $authenticatedUser->id;
        $friendRequest->receiver_id = $potentialFriend->id;
        $friendRequest->acceptance_status = "PENDING";
        $friendRequest->save();
    }
}
