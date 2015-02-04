<?php


/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('phpinfo', array(
        'as'   => 'phpinfo',
        'uses' => 'HomeController@phpinfo')
);

/*
 * Main page
 */
Route::get('/', array(
    'as'   => 'home',
    'uses' => 'HomeController@home'));

/*
 * Routes to the main page ? means that it works with or without that parameter
 */
Route::get('/category/{id}', array(
    'as'   => 'home-category',
    'uses' => 'HomeController@query'));

/*
 * Routes to the quesry search
 */
Route::post('/home/search', array(
    'as'   => 'home-search',
    'uses' => 'HomeController@searchQuery'));


/*
 * Route to Blog post
 */
Route::get('blog/post/{id}', array(
    'as'   => 'blog-post',
    'uses' => 'HomeController@show'
));

/*
 * Route to Blog post
 */
Route::get('blog/contact', 'HomeController@contact');

/*
 * Route to Blog post
 */
Route::get('blog/about', 'HomeController@about');

/*
 * Rout to privacy policy required by facebook
 */
Route::get('blog/privacy', 'HomeController@privacy');


/*
|--------------------------------------------------------------------------
|  Posts Routes
|--------------------------------------------------------------------------
|
| Routes send you to post pages where you can create, update
| edit and delete posts.
|
*/
/*
 * ##########   Authenticated Admin group    ##########
 */
Route::group(array('before' => 'admin'), function ()
{
    /*
     * Create a new Blog Post
     */
    Route::get('profile/posts/blog/create', array(
        'as'   => 'posts-create',
        'uses' => 'PostsController@getPostsCreate'
    ));

    /*
     * View all blog posts
     */
    Route::get('profile/posts/blog/all', array(
        'as'   => 'posts-all',
        'uses' => 'PostsController@getPostsAll'
    ));

    /*
     * Edits a blog post
     */
    Route::get('profile/posts/blog/{id}/edit', array(
        'as'   => 'posts-edit',
        'uses' => 'PostsController@getEditBlogPost'
    ));

    Route::group(array('before' => 'csrf'), function () /*  CSRF */
    {
        /*
         * Stores a blog post
         */
        Route::post('profile/posts/blog/store', array(
            'as'   => 'posts-store',
            'uses' => 'PostsController@postPostsStore'
        ));

        /*
         * Updates a blog post
         */
        Route::post('profile/posts/{id}/update', array(
            'as'   => 'posts-update',
            'uses' => 'PostsController@postPostsUpdate'
        ));

        /*
         * Deletes a sales/blog Post
         */
        Route::post('profile/posts/blog/{id}/destroy', array(
            'as'   => 'posts-destroy',
            'uses' => 'PostsController@postPostsDestroy'
        ));


    }); // End of CSRF Authenticated


}); // End of Authenticated Admin Group

/*
 * ##########   Authenticated User Group    ##########
 */

Route::group(array('before' => 'auth'), function ()
{

    /*
 * (GET) Shows the users profile
 */
    Route::get('/profile/posts/sales/show', array(
        'as'   => 'posts-show-sales',
        'uses' => 'PostsController@getPostsSales'
    ));

    /*
    *  (GET) Sends you to the edit sale page
    */
    Route::get('/profile/posts/sales/{id}/edit', array(
        'as'   => 'posts-edit-sales',
        'uses' => 'PostsController@getPostsSalesEdit'
    ));

    /*
     * (GET) sends you to the create sales page
     */
    Route::get('/profile/posts/sales/create', array(
        'as'   => 'sales-create',
        'uses' => 'PostsController@getSalesCreate'
    ));

    Route::group(array('before' => 'csrf'), function ()
    {

        /*
        *  (Post) Updates a sale page
        */
        Route::post('/profile/posts/sales/{id}/update', array(
            'as'   => 'posts-update-sales',
            'uses' => 'PostsController@postSalesUpdate'
        ));

        /*
         * (GET) sends you to the create sales page
         */
        Route::post('/profile/posts/sales/create', array(
            'as'   => 'sales-create-post',
            'uses' => 'PostsController@postSalesStore'
        ));

        /*
        * Deletes a sales/blog Post
        */
        Route::post('profile/posts/blog/{id}/destroy', array(
            'as'   => 'sales-destroy',
            'uses' => 'PostsController@postSalesDestroy'
        ));


    }); // End of CSRF Authenticated


}); // End of Authenticated User Group


/*
|--------------------------------------------------------------------------
| New login Routes
|--------------------------------------------------------------------------
|
|This Routes allow the user to login and logout of the website
|
*/

/*
 * ##########   Authenticated group    ##########
 */
Route::group(array('before' => 'auth'), function ()
{
    Route::group(array('before' => 'csrf'), function ()
    {

        /*
        * Changes user Password Page (POST)
        */

        Route::post('/account/change-password', array(
                'as'   => 'account-change-password-post',
                'uses' => 'AccountController@postChangePassword'
            )
        );


    }); // End of CSRF Authenticated
    /*
     * Signs out user (GET)
     */
    Route::get('/account/sign-out', array(
            'as'   => 'account-sign-out',
            'uses' => 'AccountController@getSignOut'
        )
    );

    /*
     * Changes user Password Page (GET)
     */

    Route::get('/account/change-password', array(
        'as'   => 'account-change-password',
        'uses' => 'AccountController@getChangePassword'
    ));


}); // End of Authenticated Group


/*
 * ##########   Unauthenticated Group    ##########
 */
Route::group(array('before' => 'guest'), function ()
{

    Route::group(array('before' => 'csrf'), function ()
    {

        /*
         * Create Account (POST)
         */

        Route::post('/account/create', array(
            'as'   => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));

        /*
         * Account Sign In  (POST)
         */

        Route::post('/account/sign-in/', array(
            'as'   => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));

        /*
         * Forget password page (POST)
         */

        Route::post('/account/forget-password', array(
            'as'   => 'account-forget-password-post',
            'uses' => 'AccountController@postForgetPassword'
        ));


    }); // End of CSRF Unauthenticated

    /*
     * Create Account page (GET)
     */

    Route::get('/account/create', array(
        'as'   => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));

    /*
     * Receives registration code from the email of the user (GET)
     */

    Route::get('/account/activate/{code}', array(
        'as'   => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));

    /*
     * Sign in Page (GET)
     */

    Route::get('/account/sign-in', array(
        'as'   => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

    /*
     * Password Recovery link sent through email (GET)
     */

    Route::get('/account/recover/{code}', array(
        'as'   => 'account-recover',
        'uses' => 'AccountController@getRecoverPassword'
    ));

    /*
     * Forget password page (GET)
     */

    Route::get('/account/forget-password', array(
        'as'   => 'account-forget-password',
        'uses' => 'AccountController@getForgetPassword'
    ));

    /*
     * Facebook Log in (GET)
     *
     */

    Route::get('loginUser', array(
            'as'   => 'loginUser',
            'uses' => 'AccountController@getSignInFacebook')
    );


}); // End of Unauthenticated Group


/*
|--------------------------------------------------------------------------
| Sales Routes
|--------------------------------------------------------------------------
|
| Routes send you to php artisan routes pages where you can create, update
| edit and delete posts.
|
*/

########## Authenticated Group ##########
Route::group(array('before' => 'auth'), function ()
{


    ########## Authenticated CSRF ##########
    Route::group(array('before' => 'csrf'), function ()
    {


        /*
        *  (POST) Processes the update form
        */
        Route::post('/sales/edit/{id}', array(
            'as'   => 'sales-edit-post',
            'uses' => 'SalesController@postSalesEdit'
        ));


    });
});




/*
|--------------------------------------------------------------------------
| Messages Routes
|--------------------------------------------------------------------------
|
| Routes the user messages
|
*/

/*
 * Authenticated Routes
 */
Route::group(array('before' => 'auth'), function ()
{

    /*
    * Displays all the users messages
    */
    Route::get('messages', array(
        'as'   => 'message-index',
        'uses' => 'MessageController@getIndex'
    ));

    /*
    * Displays the create message page
    */
    Route::get('messages/create', array(
        'as'   => 'message-create',
        'uses' => 'MessageController@getCreate'
    ));

    /*
    * Displays the a users message
    */
    Route::get('messages/{id}/show', array(
        'as'   => 'message-show',
        'uses' => 'MessageController@getShow'
    ));


    Route::group(array('before' => 'csrf'), function ()
    {

        /*
         * Stores a message create form
         */

        Route::post('messages/create', array(
            'as'   => 'message-store',
            'uses' => 'MessageController@postStore'
        ));

        /*
        * Displays the a users message
        */
        Route::post('messages/reply', array(
            'as'   => 'message-reply',
            'uses' => 'MessageController@postReply'
        ));

        /*
        * Displays the a users message
        */
        Route::post('messages/{id}/delete', array(
            'as'   => 'message-destroy',
            'uses' => 'MessageController@postDestroy'
        ));


    }); // End of Authenticated CSRF

}); //End of authenticated


/*
|--------------------------------------------------------------------------
| Google Robot Routes
|--------------------------------------------------------------------------
|
| Google Chrome routes for chrome web tools
|
*/

/*
 * Route to robots.txt file
 */
Route::get('robots.txt', function ()
{
    View::make('robots');
});

/*
 * Route to Google WebMaster Tools
 */
Route::get('google344990bd863a969b.html', function ()
{
    View::make('google344990bd863a969b');
});


/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
 * Events index route shows all the events. you can register teams, players, view events
 */

// ok
Route::get('events', array(
    'as'   => 'events-index',
    'uses' => 'EventsController@getIndex'
));

//ok
/*
 * Shows the teams that are subscribed to an event
 */

Route::get('events/{id}/show', array(
    'as'   => 'events-show',
    'uses' => 'EventsController@getShow'
));
/*
 * Shows All players from a team
* param 1 is the team id
 * param 2 is the event id
*/
//ok
Route::get('events/{id}/teams/{event}/id', array(
    'as'   => 'events-team-players',
    'uses' => 'EventsController@getTeamPlayers'
));


/*
 * Creates, Deletes and updates events.
 */
Route::group(array('before' => 'admin'), function () // Admin protection
{
    /*
     * Creates a paintball event
     */
    Route::get('events/create', array(
        'as'   => 'events-create',
        'uses' => 'EventsController@getEventsCreate'
    ));

    /*
 * Edits a paintball event
 */
    Route::get('events/{id}/edit', array(
        'as'   => 'events-edit',
        'uses' => 'EventsController@getEventsEdit'
    ));


    Route::group(array('before' => 'csrf'), function () // CSRF protection
    {

        /*
         * Creates a paintball event
        */
        Route::post('events/create', array(
            'as'   => 'events-store',
            'uses' => 'EventsController@postEventsStore'
        ));

        /*
        * Updates a paintball event
         */
        Route::post('events/{id}/update', array(
            'as'   => 'events-update',
            'uses' => 'EventsController@postEventsUpdate'
        ));

        /*
        * Updates event status of a paintball event
        */
        Route::post('events/{id}/status', array(
            'as'   => 'events-status',
            'uses' => 'EventsController@postEventsStatus'
        ));

        /*
        * Deletes a paintball event
        */
        Route::post('events/{id}/delete', array(
            'as'   => 'events-delete',
            'uses' => 'EventsController@postEventsDelete'
        ));
    }); // End of CSRF protection
}); // end of admin filter


/*
|--------------------------------------------------------------------------
| Player Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * Allow Player to access the requested pages if he is a player
 */
Route::group(array('before' => 'allowPlayer'), function ()
{

    /*
 *  Team join routes
 */
    Route::get('events/team/join', array(
        'as'   => 'team-join',
        'uses' => 'TeamsController@getTeamJoin'
    ));


});

/*
 * Denies access to paintball players
 */
Route::group(array('before' => 'denyPlayer'), function ()
{
    /*
*  Player registration routes
*/
    Route::get('events/player/create-player', array(
        'as'   => 'player-create',
        'uses' => 'PlayerController@getPlayerCreate'
    ));

});


/*
* Route Group the players
*/

Route::group(array('before' => 'auth'), function ()
{
    /*
    *  Player registration routes
    */
    Route::get('events/player/registered', array(
        'as'   => 'player-registered',
        'uses' => 'PlayerController@getPlayerRegistered'
    ));


});

/*
 *  Player registration routes
 */
Route::get('events/player/create-player-user', array(
    'as'   => 'player-user-create',
    'uses' => 'PlayerController@getPlayerUserCreate'
));


/*
 *  Player store routes
 */
Route::post('events/player/store', array(
    'as'   => 'player-store',
    'uses' => 'PlayerController@postPlayerStore'
));


/*
|--------------------------------------------------------------------------
| Team Registration Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'allowPlayer'), function () // ALLOW PLAYER
{


    /*
     *  Team registration routes
     */
    Route::get('events/team/create', array(
        'as'   => 'team-create',
        'uses' => 'TeamsController@getTeamCreate'
    ));

    Route::group(array('before' => 'csrf'), function () // CSRF
    {

        /*
         *  Team store routes
         */
        Route::post('events/team/store', array(
            'as'   => 'team-store',
            'uses' => 'TeamsController@postTeamStore'
        ));

    }); // End of CSRF

}); // End of allow player Group


/*
 * restrict access to only players that have a team
 */

Route::group(array('before' => 'denyPlayerWithoutTeam'), function () //Deny Player Without Team
{
    /*
 * routes the player to the events team
 */

    Route::get('events/registration/{id}/event', array(
        'as'   => 'events-join',
        'uses' => 'EventsController@getJoinEvent'
    ));

    Route::group(array('before' => 'csrf'), function () // CSRF
    {
        /*
         * routes the player to the events team
         */

        Route::post('events/registration/{id}/event', array(
            'as'   => 'events-join-post',
            'uses' => 'EventsController@postJoinEvent'
        ));

    }); // End of CSRF


});// End of route filter


Route::group(array('before' => 'allowPlayer'), function ()
{ // Allow Player

    /*
     *  Team joins team routes
     */
    Route::post('events/team/join', array(
        'as'   => 'team-join-post',
        'uses' => 'TeamsController@postTeamJoin'
    ));

    Route::group(array('before' => 'csrf'), function ()
    { //CSRF

        /*
         *  Team join routes
         */
        Route::post('events/team/{id}/destroy', array(
            'as'   => 'team-destroy-post',
            'uses' => 'TeamsController@postTeamDestroy'
        ));
    }); // End of CSRF


}); // End of allowPlayer filter

/*
|--------------------------------------------------------------------------
| Game Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'admin'), function ()
{

    /*
     *  games create routes
     */
    Route::get('events/{id}/games/create', array(
        'as'   => 'games-create',
        'uses' => 'GamesController@getGamesCreate'
    ));
    Route::group(array('before' => 'csrf'), function ()
    {

        /*
         *  games create routes for storing
         */
        Route::post('events/{id}/games/create', array(
            'as'   => 'games-store-post',
            'uses' => 'GamesController@postGamesStore'
        ));
    }); // End od CSRF


}); //end of admin filter


/*
 *  games create routes for storing
 */
Route::get('events/{id}/games/show', array(
    'as'   => 'games-show',
    'uses' => 'GamesController@getGamesShow'
));

/*
|--------------------------------------------------------------------------
| Gallery Routes
|--------------------------------------------------------------------------
|
| Here are the routes that direct you to the gallery
|
*/


Route::group(array('before' => 'admin'), function ()// Admin
{

    Route::get('gallery/create', array(
        'as'   => 'gallery-create',
        'uses' => 'GalleryController@getCreate'
    ));

    Route::get('gallery/{id}/edit', array(
        'as'   => 'gallery-edit',
        'uses' => 'GalleryController@getEdit'
    ));

    Route::post('gallery/store', array(
        'as'   => 'gallery-store',
        'uses' => 'GalleryController@postStore'
    ));


    Route::group(array('before' => 'csrf'), function () // CSRF
    {


        Route::post('gallery/{id}/destroy', array(
            'as'   => 'gallery-destroy',
            'uses' => 'GalleryController@postDestroy'
        ));

        Route::post('gallery/{id}/update', array(
            'as'   => 'gallery-update',
            'uses' => 'GalleryController@postUpdate'
        ));
    }); // End of CSRF

});


Route::get('gallery/index', array(
    'as'   => 'gallery-index',
    'uses' => 'GalleryController@getIndex'
));


Route::get('gallery/{id}/show', array(
    'as'   => 'gallery-show',
    'uses' => 'GalleryController@getShow'
));

/*
|--------------------------------------------------------------------------
| Slider Routes
|--------------------------------------------------------------------------
|
| Routes to change the main banners images
|
*/


Route::group(array('before' => 'admin'), function ()// Admin
{
    /*
     * Displays list of all bannerss
     */

    Route::get('banners/index', array(
        'as'   => 'banners-index',
        'uses' => 'BannersController@getIndex'
    ));

    /*
     * Displays a specific banners information
     */

    Route::get('banners/{id}/show', array(
        'as'   => 'banners-show',
        'uses' => 'BannersController@getShow'
    ));

    /*
     * Displays page to upload Banners
     */
    Route::get('banners/create', array(
        'as'   => 'banners-create',
        'uses' => 'BannersController@getCreate'
    ));

    /*
     * Edits a banners
     */
    Route::get('banners/{id}/edit', array(
        'as'   => 'banners-edit',
        'uses' => 'BannersController@getEdit'
    ));

    /*
     * Stores the banners
     */
    Route::post('banners/store', array(
        'as'   => 'banners-store',
        'uses' => 'BannersController@postStore'
    ));

    /*
     * Test ***DELETE***
     */
    Route::get('banners/test',array(
       'as' => 'banners-test',
        'uses' => 'BannersController@getTest'
    ));


    Route::group(array('before' => 'csrf'), function () // CSRF
    {

        /*
         * Deletes a banners
         */
        Route::post('banners/{id}/destroy', array(
            'as'   => 'banners-destroy',
            'uses' => 'BannersController@postDestroy'
        ));

        /*
         * Updates a banners
         */
        Route::post('banners/{id}/update', array(
            'as'   => 'banners-update',
            'uses' => 'BannersController@postUpdate'
        ));
    }); // End of CSRF

});





















