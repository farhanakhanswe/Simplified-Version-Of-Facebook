<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchPostOfFriendRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class SearchPostsOfMyFriendController extends Controller
{
    public function searchThroughThePostsOfMyFriends(SearchPostOfFriendRequest $request)
    {
        try {
            $user = Auth::user();
            $query = $request->query;
            $friends = $user->friends;

            return $this->searchResults($friends, $query);
            
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    private function searchResults($friends, $query)
    {
        $searchResults = [];

        foreach ($friends as $friend) {
            $searchResults = Post::where('user_id', $friend->id)
                ->where('title', 'LIKE', '%' . $query . '%')
                ->latest()
                ->get();

            array_push($searchResults, $searchResults);
        }

        return $searchResults;
    }
}
