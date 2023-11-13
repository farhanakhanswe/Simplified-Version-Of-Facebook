<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Http\Controllers\Controller;
use Exception;
use FriendRequestAcceptanceHelper;
use Illuminate\Support\Facades\Auth;

class SendFriendRequestController extends Controller
{
    public function sendFriendRequest(User $user)
    {
        try{
            $authenticatedUser = Auth::user();
            $potentialFriend = $user;

            return $this->sendRequest($authenticatedUser, $potentialFriend);
           
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
       
    }

    private function sendRequest($authenticatedUser, $potentialFriend)
    {
        try{
            $friendRequest = new FriendRequest();
            $friendRequest->sender_id = $authenticatedUser->id;
            $friendRequest->receiver_id = $potentialFriend->id;
            $friendRequest->acceptance_status =  FriendRequestAcceptanceHelper::PENDING;
            $friendRequest->save();
            
            return $friendRequest;

        }catch(Exception $e)
        {
            return $e->getMessage();
        }
       
    }
}
