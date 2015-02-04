<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/15/15
 * Time: 10:45 AM
 * Ide:  PhpStorm
 */
class GamesController extends BaseController {


    public function getGamesCreate($event_id)
    {

        // get the information from the event
        $event = Pbevent::find($event_id);

        //get all the teams that are in the event
        $teams = Pbevent::getEventTeamsWithId($event_id);

        // get all the games where the event matches the event_id
        $games = Pbevent::getEventGamesWithId($event_id);

        return View::make('events.games.create')
            ->with('event', $event)
            ->with('teams', $teams)
            ->with('games', $games);
    }


    public function postGamesStore($event_id)
    {

  //Get the input

        // home games
        $home = Input::get('homeGames');

        //away games
        $away = Input::get('awayGames');

        //Home Score
        $homeScore = Input::get('team_1_score');

        //Away Score
        $awayScore = Input::get('team_2_score');

        //validate the input


        // get the information from the event
        $event = Pbevent::find($event_id);

        //delete all the games from the table
        $delete = Pbgame::where('pbgames_event_id','=',$event_id)->get();
          if($delete->count()){
              foreach($delete as $deleteGame){
                  Pbgame::where('id','=',$deleteGame->id)->delete();
              }
          }

        // get all the teams from the event
        $teams = Pbevent::getEventTeamsWithId($event_id);

        for ($i = 0; $i <= sizeof($home)-1; $i ++)
        {

            DB::table('pbgames')
                ->insert(array('team_1_id'        => $home[$i],
                                    'team_2_id'        => $away[$i],
                                    'team_1_score'        => Pbgame::Validatescores($homeScore[$i]),
                                    'team_2_score'        => Pbgame::Validatescores($awayScore[$i]),
                                    'pbgames_event_id' => $event_id
                    )
                );
        }

        // get all the games where the event matches the event_id
        $games = Pbevent::getEventGamesWithId($event_id);


        // look to see if this game exists


        return View::make('events.games.create')
            ->with('event', $event)
            ->with('teams', $teams)
            ->with('games', $games);
    }

    /*
     * Returns view of games with scores
     */
    public function getGamesShow($event_id){

        // get all the teams from the event
        $teams = Pbevent::getEventTeamsWithId($event_id);

        // get all the games where the event matches the event_id
        $games = Pbevent::getEventGamesWithId($event_id);

        // get the information from the event
        $event = Pbevent::find($event_id);



        return View::make('events.games.show')
            ->with('event', $event)
            ->with('teams', $teams)
            ->with('games', $games);


    }


}