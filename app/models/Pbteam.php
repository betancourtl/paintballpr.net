<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 7:29 PM
 * Ide:  PhpStorm
 */
class Pbteam extends Eloquent {

    // Properties

    protected $guarded = array();

    protected $fillable = array();


    public static $rules = array(
        'name' => 'required|unique:pbteams',
        'division'=> 'required',
        'password'=>'required|confirmed|min:6|max:16',
    );

     // ok works
    public function Pbevents()
    {
        return $this->belongsToMany('Pbevent', 'pbevents_pbteams', 'event_id', 'event_team_id');
    }

    // link to the divisions ok works
    public function Pbplayers()
    {
        return $this->belongsToMany('Pbplayer', 'pbplayers_pbteams', 'player_id', 'player_team_id');
    }


    // returns all the teams paintball scores
    public function pbscores()
    {
        return $this->hasMany('Pbscore');
    }

    // returns all the team games
    public function pbgames(){
        return $this->hasMany('Pbgame');
    }

    //validate the team
    public static function validateNewTeam($data){
        return Validator::make($data,static::$rules);
    }



}