<?php

class ProfileController extends BaseController {


    /*
     * Main profile page
     */
    public function getProfilePosts(){

        // Return the posts from the database

        // Find the user with the ID stored in the session
        $user = User::find(Auth::user()->id)->get();

       // Get the user
        $user = $user->first();

        //find the posts
        $posts = Post::where('user_id','=',$user->id)->get();

        return View::make('/profile/posts/sales/show')
            ->with('user',$user)
            ->with('posts',$posts);
    }


}// End of controller
