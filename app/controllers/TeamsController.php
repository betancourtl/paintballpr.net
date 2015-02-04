<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/11/15
 * Time: 11:10 PM
 * Ide:  PhpStorm
 */
class TeamsController extends BaseController {

    public function getTeamCreate()
    {

        //get all the divisions
        $divisions = Pbdivision::all();

        return View::make('events.registration.team.create')
            ->with('divisions', $divisions);

    }

    public function postTeamStore()
    {
        $validation = Pbteam::validateNewTeam(Input::all());
        if ($validation->fails())
        {


            return Redirect::route('team-create')
                ->withErrors($validation)
                ->withInput();
        } else
        {
            $team = Pbteam::create(array(
                'name'          => Input::get('name'),
                'division_id'   => Input::get('division'),
                'team_password' => Hash::make(Input::get('password'))
            ));

            //Gets pbplayer using the users user.id
            $player = Pbplayer::where('player_user_id', '=', Auth::user()->id)->first(); // post id


            // Add player_team_id player_id and the player_role_id
            DB::table('pbplayers_pbteams')->insert(
                array('player_team_id' => $team->id,
                      'player_id'      => $player->id,
                      'player_role_id' => '3' // Make him the captain of the team
                ));


            if ($team)
            {
                return Redirect::back()
                    ->with('message', 'Team has been created');
            }
        }
    }

    public function getTeamJoin()
    {
        $teams = DB::table('pbteams')
            ->leftJoin('pbdivisions', 'pbteams.id', '=', 'pbdivisions.id')->get();


        return View::make('events.registration.team.join')
            ->with('teams', $teams)
            ->with('players', Pbplayer::getPlayerWithUserId(Auth::User()->id));

    }

    public function postTeamJoin()
    {
        //get the team password
        $password = Input::get('password');

        //get the team id from the team name
        $teamToJoin = Pbteam::where('name', '=', Input::get('team'))->get();

        // check if the team exists
        if ($teamToJoin->count())
        {
            // get inside the array
            $teamToJoin = $teamToJoin->first();

            // check the password
            if (Hash::check($password, $teamToJoin->team_password))
            {

            } else
            {

                // redirect if the player is already part of the team
                return Redirect::route('team-join')
                    ->withInput()
                    ->with('message', 'Password is incorrect');
            }


            //get the teams that the player has joined
            $validation = Pbplayer::getPlayerTeamsWithUserId(Auth::user()->id);

            // loop th teams and check to see if the player is already part of the team
            foreach ($validation->pbteams as $team)
            {
                if ($team->id == $teamToJoin->id)
                {

                    // redirect if the player is already part of the team
                    return Redirect::route('team-join')
                        ->with('message', 'You are already part of that team!');
                }

                // check to see that the password matches

            }

            //Gets pbplayer using the users user.id
            $player = Pbplayer::where('player_user_id', '=', Auth::user()->id)->first(); // post id

            //add the player to the team in the pbplayers_pbteams table
            //DELETE
//            $player->pbteams()->attach($teamToJoin->id);

            // Add player_team_id player_id and the player_role_id
            DB::table('pbplayers_pbteams')->insert(
                array('player_team_id' => $teamToJoin->id,
                      'player_id'      => $player->id,
                      'player_role_id' => '1' // player id is 1
                ));


            //get all the teams
            $teams = Pbteam::all();
            $divisions = Pbdivision::all();

            return Redirect::route('team-join')
                ->with('teams', $teams)
                ->with('divisions', $divisions)
                ->with('players', Pbplayer::getPlayerWithUserId(Auth::user()->id))
                ->with('message', 'You have joined the team');

        } else
        {
            // if team name is incorrect then return back to the join team page

            //get all the teams
            $teams = Pbteam::all();
            $divisions = Pbdivision::all();


            return Redirect::route('team-join')
                ->with('teams', $teams)
                ->with('divisions', $divisions)
                ->with('players', Pbplayer::getPlayerWithUserId(Auth::user()->id))
                ->with('message', 'Team does not exist')
                ->withInput();

        }
    }

    //delete the player from the team

    /*
     * id int param - Team id tht the user wants to leave from
     */

    public function postTeamDestroy($team_id)
    {

        Pbplayer::deletePlayerFromTeam($team_id, Auth::user()->id);

        return Redirect::route('team-join')
            ->with('message', 'You left the team');
    }


}