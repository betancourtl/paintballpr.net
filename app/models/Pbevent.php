<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 7:28 PM
 * Ide:  PhpStorm
 */

 


class Pbevent extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
        'event' => 'required|unique:pbevents',
        'date' => 'required'

    );

    // Rules used to update the event
    public static $updateRules = array(
        'event' => 'required', //name is required but does not have to be unique
        'date' => 'required' // date is required

    );

    // Model Bindings
    public function pbteams(){ // function name
        return $this->belongsToMany('Pbteam','pbevents_pbteams','event_id','event_team_id'); // model name
    }


    // Validation

    // validates event create
    public static function validateEvent($data){
        return Validator::make($data,static::$rules);
    }

    // validates event create
    public static function validateEventUpdate($data){
        return Validator::make($data,static::$updateRules);
    }

    // Get all the teams that are registered in an event
    public static function getEventTeamsWithId($event_id){

     return   $teams = Pbevent::with('Pbteams')
            ->where('id', '=', $event_id)
            ->first();
    }

    // Get the games from an event using the event id
    public static function getEventGamesWithId($event_id){
        return Pbgame::where('pbgames_event_id','=',$event_id)->get();

    }
    
    

}