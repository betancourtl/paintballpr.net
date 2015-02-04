<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 9:25 PM
 * Ide:  PhpStorm
 */
class Pbplayer extends Eloquent {

    // Properties

    protected $guarded = array();

    protected $fillable = array();


    public static $rules = array(
        'first_name'  => 'required',
        'last_name'   => 'required',
        'cell-start'  => 'required|digits:3',
        'cell-middle' => 'required|digits:3',
        'cell-last'   => 'required|digits:4',
    );

    // Model Bindings

    // get the roles of the paintball player
    public function Pbroles()
    {
        return $this->hasOne('Pbrole', 'id', 'player_role_id'); // model
    }

    // gets the user that is a paintball player
    public function user()
    {
        return $this->hasOne('User', 'id', 'player_user_id'); // model
    }

    // gets the teams that the player belongs to
    public function pbteams()
    {
        return $this->belongsToMany('Pbteam', 'pbplayers_pbteams', 'player_id', 'player_team_id'); // model
    }

    // gets the image from the paintball player
    public function pbimages()
    {
        return $this->hasOne('Pbimage', 'id', 'player_image_id'); // model
    }

    // gets the image from the paintball player
    public function pbdivisions()
    {
        return $this->hasManyThrough('pbdivision', 'pbteam', 'division_id', 'id');
    }


    // validate creation of player

    public static function validateNewPlayer($data)
    {
        return Validator::make($data, static::$rules);
    }


    // gets the teams the player belongs to using the user.id
    /*
     * Function accepts the user id as a parameter (INT)
     */

    public static function getPlayerWithUserId($id)
    {

        return $team = Pbplayer::where('player_user_id', '=', $id)
            ->with('Pbteams', 'User', 'Pbroles', 'Pbimages')->first(); // calls the method

    }


    /*
     *   Checks to see if the user is a player
     *   returns true or false
     */

    public static function isPlayer($id)
    {

             $team = Pbplayer::where('player_user_id', '=', $id)
            ->with('Pbteams', 'User', 'Pbroles', 'Pbimages')->get(); // calls the method

        if ($team->count()){
            return true;
        }else{
            return false;
        }
    }

    // gets the teams the player belongs to using the player_id
    /*
     * Function accepts the user id as a parameter (INT)
     */

    public static function getPlayerWithPlayerId($id)
    {

        return $team = Pbplayer::where('id', '=', $id)
            ->with('Pbteams', 'User', 'Pbroles', 'Pbimages')->first(); // calls the method

    }

    // gets the teams the player belongs to using the player_id
    /*
     * Function accepts the user id as a parameter (INT)
     */

    public static function getPlayerTeamsWithUserId($id)
    {

        return $team = Pbplayer::where('player_user_id', '=', $id)
            ->with('Pbteams')->first(); // calls the method

    }

    /*
     * Get the players from the team using the team id
     */
    public static function getPlayersFromTeam($id)
    {
        return $eventTeamPlayers = DB::table('pbplayers_pbteams')
            // Team the players belong to
            ->leftJoin('pbteams', 'pbplayers_pbteams.player_team_id', '=', 'pbteams.id')
            ->leftJoin('pbplayers', 'pbplayers_pbteams.player_id', '=', 'pbplayers.player_user_id')
            ->leftJoin('users', 'pbplayers.player_user_id', '=', 'users.id')
            ->leftJoin('pbroles', 'pbplayers.player_role_id', '=', 'pbroles.id')
            ->where('pbteams.id', '=', $id)
            ->get();

    }

    /*
     *  remove player from team
     * param 1 $id int - team id that the player wants to leave
     * param2 $user_id - user_id
     */
    public static function deletePlayerFromTeam($team_id, $user_id)
    {

        /*
         * Selects all the players from the pbplayers_pbteams table
         * and finds the record mathing the team id and the player_id
         */
        $team = DB::table('pbplayers_pbteams')
            ->where('player_team_id', '=', $team_id)
            ->where('player_id', '=', Pbplayer::getPlayerWithUserId($user_id)->id)
            ->select('id')->get();

        // loops the tems and deletes them. It should only find 1 result but i can't figure
        //out how to return just 1 result.
        foreach ($team as $deleteTeam)
        {
            DB::table('pbplayers_pbteams')
                ->delete($deleteTeam->id);

        }

    }

    /*
     * Adds the team to the event if the player is part
     * of the team ans is not already registered in it
    *
     * returns true or false
    */
    public static function joinEvent($event_id, $team_id, $user_id)
    {


        $ok = false;  // make the flag false;

        // check to see if the player is part of the team
        $teams = Static::getPlayerTeamsWithUserId($user_id)->pbteams;

        if ($teams->count())
        {
            foreach ($teams as $team)
            {
                if ($team_id == $team->id)
                {
                    $ok = true; //allow the checks to continue
                }

            }
        }
        if($ok) // if the player belongs to the team
        {
            // check to see if the team is already registered in the event
            $registered = DB::table('pbevents_pbteams')
                ->where('pbevents_pbteams.event_id', '=', $event_id)
                ->where('pbevents_pbteams.event_team_id', '=', $team_id)
                ->get();

            if (sizeof($registered) >= 1)
            {
                return false; // the team is already registered
            }else{

                // join the event
                $events = Pbevent::find($event_id);
                $events->pbteams()->attach($team_id);

                return true; // The team was added to the event
            }
        }


        //return message team is already registered in the event

    }


}