<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Http\Controllers\Controller;
use Exception;
use FriendRequestAcceptanceHelper;
use Illuminate\Support\Facades\Auth;

class FriendRequestResponseController extends Controller
{
    public function accept(FriendRequest $friendRequest)
    {
        try {
            $user = Auth::user();
            $friendRequest->acceptance_status = FriendRequestAcceptanceHelper::ACCEPTED;
            $friendRequest->save();

            $this->connectUsertoFriend($user, $friendRequest);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function reject(FriendRequest $friendRequest)
    {
        try {
            $friendRequest->acceptance_status = FriendRequestAcceptanceHelper::REJECTED;
            $friendRequest->save();
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function connectUsertoFriend($user, $friendRequest)
    {
        try {
            $friend = User::find($friendRequest->receiver_id)->first();

            return $user->friends()->attach($friend);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
