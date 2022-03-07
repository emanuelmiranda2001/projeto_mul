<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FPost;
use App\Models\Fpost_Comment;
use Illuminate\Support\Facades\Auth;

class FpostCommentsController extends Controller
{
    public function postComment(Request $request)
    {
        $this->validate($request, [
            'comment'   => 'required'
        ]);

            $comment = Fpost_Comment::create([
                'f_post_id' => $request->input('id'),
                'user_id'    => Auth::user()->id,
                'comment'    => $request->input('comment'),
            ]);

            return redirect()->back()->with("status", "Your comment has been submitted.");
    }
}
