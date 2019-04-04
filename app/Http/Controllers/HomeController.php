<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\PostAction;
use Auth;
use Session;
use App\Jobs\PostAction as PostActionJob;
use Illuminate\Support\Facades\Queue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('home')->with(compact('posts'));
    }

    /**
     * To perform an action on post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postAction(Request $request, $type, $post_id)
    {
        // get post by post_id
        $post = Post::find($post_id);
        // get posted by
        $postedBy = $post->postedBy;
        // user who permormed action
        $current_user = $request->user();
        // get user agent
        $user_agent = $request->server('HTTP_USER_AGENT');
        // get current user IP
        $clientIP = $request->ip();

        // convert string type to integer
        if($type === 'like'){
            $post->action_type = 'post-like';
            $post->notification_title = 'You have just liked post';
            $post->notification_message = "You have just liked ".$postedBy->name."'s post: ".$post->title;
        }elseif($type === 'comment'){
            $post->action_type = 'post-comment';
            $post->notification_title = 'You have just commented on post';
            $post->notification_message = "You have just commented on ".$postedBy->name."'s post: ".$post->title;
        }elseif($type === 'share'){
            $post->action_type = 'post-share';
            $post->notification_title = 'You have just shared post';
            $post->notification_message = "You have just shared ".$postedBy->name."'s post: ".$post->title;;
        }

        $postJob =  Queue::later(5,new PostActionJob($post, $current_user, $postedBy, $user_agent, $clientIP));

        Session::flash('message', $post->notification_message); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
    }
}
