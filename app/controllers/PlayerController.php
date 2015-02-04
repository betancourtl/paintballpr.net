<?php

class PlayerController extends BaseController {

    public function getPlayerCreate()
    {
        return View::make('events.registration.player.create');
    }

    public function getPlayerUserCreate()
    {
        return View::make('events.registration.player.create-user-player');
    }

    public function getPlayerRegistered()
    {
        return View::make('events.registration.player.player-registered');
    }

    public function postPlayerStore()
    {

        if (Auth::check())
        {
            // If the user is authenticated then validate
            $validation = Pbplayer::validateNewPlayer(Input::all());

            if ($validation->fails())
            {
                return Redirect::back()
                    ->with('message', 'Player was not created')
                    ->withErrors($validation)
                    ->withInput();

                // if the user is logged in
            }

            // update the player information if he is not registered

            // get the user _id
            $user_id = Auth::user()->id;

            // find the user_id  in the pbplayer table
            $player_id = Pbplayer::where('player_user_id', '=', $user_id);

            // if it finds the user_id in the players table
            if ($player_id->count())
            {
                //redirect back
                return Redirect::back()
                    ->with('message', 'You are already registered as a player');
            } else
            {

                // Create a new player
                $newPlayer = Pbplayer::create(array(

                    'player_role_id'  => 1, // player
                    'player_image_id' => 1, // player default
                    'player_user_id'  => $user_id

                ));

                // update the user table
                $updateUser = User::find($user_id);
                $updateUser->first_name = Input::get('first_name');
                $updateUser->last_name = Input::get('first_name');
                $updateUser->cell = Input::get('cell-start') . Input::get('cell-middle') . Input::get('cell-last');

                //save the updated information from the user
                $updateUser->save();

                return Redirect::route('events-index')
                    ->with('message', 'Your profile has been updated and you are now registered as a player!');
            }
        } else
        {     //create user and add the player information
            $validate_user = Validator::make(Input::all(),
                array(
                    'email'            => 'required|max:50|email|unique:users',
                    'username'         => 'required|max:20|min:3|unique:users',
                    'password'         => 'required|min:6|confirmed',
                    'password_confirmation' => 'required'
                ));

            // If the user is authenticated then validate
            $validatePlayer = Pbplayer::validateNewPlayer(Input::all());

            if ($validate_user->fails() || $validatePlayer->fails())
            {
                //merge errors

                $errors = $validate_user->errors();
                $errors->merge($validatePlayer->errors());

                return Redirect::back()
                    ->with('message', 'error')
                    ->withInput()
                    ->withErrors($errors);
            } else
            {
                // Get the Values
                $email = Input::get('email');
                $username = Input::get('username');
                $password = Input::get('password');
                $first_name = Input::get('first_name');
                $last_name = Input::get('last_name');
                $cell = Input::get('cell-start') . Input::get('cell-middle') . Input::get('cell-last');



                //activation code
                $code = str_random(60);

                //create user
                $user = User::create(array(
                    'username'   => $username,
                    'email'      => $email,
                    'first_name' => $first_name,
                    'last_name'  => $last_name,
                    'cell'       => $cell,
                    'password'   => Hash::make($password),
                    'code'       => $code,
                    'active'     => 0,
                    'role_id'    => 4
                ));

                // create a new player
                $newPlayer = Pbplayer::create(array(

                    'player_role_id'  => 1, // player
                    'player_image_id' => 1, // player default
                    'player_user_id'  => $user->id

                ));

                // user was registered
                if ($user)
                {

                    //send activation email
                    Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function ($message) use ($user)
                    {
                        $message->to($user->email, $user->username)
                            ->subject('activate your account');
                    });

                    return Redirect::route('player-create')
                        ->with('message', 'Your account has been created We have sent you an email to activate your account');


                }
            }
        }

    }


}