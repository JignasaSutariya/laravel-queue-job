<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Post;
use App\User;
use App\PostAction as PostActionModel;
use Auth;

class PostAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $action_type;
    public $notification_title;
    public $notification_message;
    public $current_user;
    public $posted_by;
    public $user_agent;
    public $clientIP;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $current_user, User $posted_by, $user_agent, $clientIP)
    {
        $this->post = $post;
        $this->action_type = $post->action_type;
        $this->notification_title = $post->notification_title;
        $this->notification_message = $post->notification_message;
        $this->current_user = $current_user;
        $this->posted_by = $posted_by;
        $this->user_agent = $user_agent;
        $this->clientIP = $clientIP;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // add action on post in db
        $post_action = New PostActionModel();
        $post_action->post_id = $this->post->id;
        $post_action->user_id = $this->current_user->id;
        $post_action->user_agent = $this->user_agent;
        $post_action->user_ip_address = $this->clientIP;
        $post_action->type = $this->action_type;
        $post_action->title = $this->notification_title;
        $post_action->description = $this->notification_message;
        $post_action->save();
    }

    public function failed(Exception $e)
    {
        dd($e);
    }
}


