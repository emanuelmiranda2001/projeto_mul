<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FPost;
use Illuminate\Support\Facades\Auth;

class FpostsController extends Controller
{
        public function create()
        {
                return view('fposts.create');
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                    'title'     => 'required',
                    'message'   => 'required'
                ]);

                $fpost = new Fpost([
                    'title'     => $request->input('title'),
                    'user_id'   => Auth::user()->id,
                    'message'   => $request->input('message'),
                    'status'    => "Pending",
                ]);

                $fpost->save();

                return redirect()->back()->with("status", "A post with ID: #$fpost->id has been opened.");
        }

        public function indexFposts(){
            $fposts = FPost::where('status', 'open')->paginate(10);
            return view('fposts.index_fposts', compact('fposts'));
        }

        public function show($id)
        {
            $fpost = FPost::where('id',$id)->firstOrFail();
            $comments = $fpost->comments;

            return view('fposts.show',compact('fpost','comments'));
        }

        public function allFposts()
        {
            $fposts = FPost::paginate(10);

            return view('fposts.allposts', compact('fposts'));
        }

        public function edit($id)
        {
            $fpost = FPost::where('id',$id)->firstOrFail();
            if(Auth::user()->id != $fpost->user_id)
            {
                return redirect()->back()->with('error','You don\'t have the rights to edit that post.');
            }
            return view('fposts.create',compact('fpost'));
        }

        public function update($id,Request $request)
        {
            $this->validate($request, [
                'title'     => 'required',
                'message'   => 'required'
            ]);

            $fpost = FPost::where('id', $id)->firstOrFail();
            $fpost->title = $request->title;
            $fpost->message = $request->message;
            $fpost->save();
            $comments = $fpost->comments;
            return view('fposts.show',compact('fpost','comments'));

        }

        public function status($id,Request $request)
        {
            $fpost = FPost::where('id', $id)->firstOrFail();
            
            $fpost->status = $request->open ? 'Open' : 'Closed';

            $fpost->save();

            return redirect()->back()->with("status", "The ticket's status has been altered.");
        }
}
