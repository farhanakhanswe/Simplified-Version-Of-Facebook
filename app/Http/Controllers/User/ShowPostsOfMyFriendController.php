<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class ShowPostsOfMyFriendController extends Controller
{
    public function showPostsOfMyFriends()
    {
        try{
            $user = Auth::user();

            $friendIds = FriendRequest::where(['sender_id' =>  $user->id, 'is_accepted' => 1])->pluck('receiver_id');

            $postsOfMyFriends = [];

            foreach ($friendIds as $friendId) {
                $posts = Post::where('user_id', $friendId)->latest()->get();

                array_push($postsOfMyFriends, [$friendId => $posts]);
            }
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
       
    }
}
