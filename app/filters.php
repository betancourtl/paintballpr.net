<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request)
{
    //
});


App::after(function ($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function ()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        } else
        {    //redirects to a view
            return Redirect::guest('account/sign-in');
        }
    }
});

Route::filter('auth.basic', function ()
{
    return Auth::basic();
});


/*
 * Filter checks that only the administrators have access
 * the CMS admin section.
 *
 */

Route::filter('captain', function ()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        } else
        {    //redirects to a view
            return Redirect::guest('account/sign-in');
        }
    }
});

/*
 * Filter checks that only the administrators have access
 * the CMS.
 *
 */

Route::filter('admin', function ()
{
    // if the user is not logged in or if he does not have
    // Administrator roles then prevent access to the page
    if (Auth::user() && Auth::user()->role_id == 1)
    {

    } else
    {
        return Redirect::back()
            ->with('message', 'Opps! you do not have administrator privileges');
    }
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function ()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function ()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});


Route::filter('allowPlayer', function ()
{
    // if the player is not logged in redirect him to the create player page
    if (Auth::guest())
    {

        return Redirect::route('player-user-create')
            ->with('message','You must log in or register to view the page');
    // if the user is authenticated check to see if he is a player
    } elseif (Auth::check())
    {
        //get the user id
        $user_id = Auth::User()->id;

        $player = Pbplayer::where('player_user_id', '=', $user_id);

        // look to see of there is a player already registered
        if ($player->count())
        {   //redirect to the intended page if he is registered as a player

        } else
        {
            // if the user is authenticated but not a player then
            //redirect him to the player create page
            return Redirect::route('player-create')
                ->with('message', 'You must be registered as a player in order to join a team!');
        }
    }

    /*
     * Deny Player access
     */
});Route::filter('denyPlayer', function ()
{
    // if the player is not logged in redirect him to the create player page
    if (Auth::guest())
    {
        return Redirect::route('player-user-create');
    // if the user is authenticated check to see if he is a player
    } elseif (Auth::check())
    {
        //get the user id
        $user_id = Auth::User()->id;

        $player = Pbplayer::where('player_user_id', '=', $user_id);

        // look to see of there is a player already registered
        if ($player->count())
        {
            //redirect him to the player create page
            return Redirect::back()
                ->with('message', 'You are already registered as a paintball player');
        }

    }

    /*
 * Deny Player access if he is not part of a team
 */
});Route::filter('denyPlayerWithoutTeam', function ()
{
    // if the player is not logged in redirect him to the create player page
    if (Auth::guest())
    {
        return Redirect::route('player-user-create');
        // if the user is authenticated check to see if he is a player
    } elseif (Auth::check())
    {
        //check to see if he is a player
        $isPlayer = Pbplayer::isPlayer(Auth::user()->id);

        if($isPlayer)
        {

            //get the teams that the player plays for
            $teams = Pbplayer::getPlayerTeamsWithUserId(Auth::user()->id);

            // look to see of the player has team
            // if he does then do nothing and let the routes do the routing
            if ($teams->pbteams->count())
            {

                //Do nothing

            } else
            {

                //redirect him to the player create page
                return Redirect::route('events-index')
                    ->with('message', ' You have to join a team to join an event');

            }
        }else{
            //redirect him to the player create page
            return Redirect::route('player-create')
                ->with('message', ' You have to register as a player');


        }

    }


});