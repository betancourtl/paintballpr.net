<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/6/15
 * Time: 3:26 PM
 * Ide:  PhpStorm
 */
class EventsController extends BaseController {

    /*
     * Gets the events index page
     */
    public function getIndex()
    {
        return View::make('events.index')
            ->with('events', Pbevent::with('pbteams')
                ->orderBy('created_at', 'DESC')
                ->get());
    }

    /*
     * Gets all the teams that are playing an event
     */
    public function getShow($id)
    {
        return View::make('events.events.show')
            ->with('event', Pbevent::where('id', '=', $id)
                ->with('pbteams')->first());


    }

    /*
     *
     */
    public function getTeamPlayers($id, $event_id)
    {

        // players that belong to a team that are going to an events

        $eventTeamPlayers = Pbplayer::getPlayersFromTeam($id);

        $eTP = ''; // defining the array for php storm
        if (count($eventTeamPlayers))
        {

            foreach ($eventTeamPlayers as $eventTeam)
            {
                $eTP[] = $eventTeam;

            }
        } else
        {
            $eTP = null;

        }

        $event = Pbevent::where('id', '=', $event_id)->first();

        return View::make('events.events.event-team-players')
            ->with('players', $eTP)
            ->with('event', $event);

    }

    /*
     * Creates an event
     */
    public function getEventsCreate()
    {

        return View::make('events.events.create')
            ->with('events', Pbevent::all());

    }

    /*
     * Creates an event
     */
    public function postEventsStore()
    {

        // validate event
        $validation = Pbevent::validateEvent(Input::all());

        if ($validation->fails())
        {

            return Redirect::route('events-create')
                ->with('message', 'Failed to create event')
                ->withInput()
                ->withErrors($validation);

        } else
        {

            Pbevent::create(array(
                'event' => Input::get('event'),
                'date'  => Input::get('date'),
                'status'=> 0 // event is open
            ));

            return Redirect::route('events-create')
                ->with('message', 'Event created');


        }

    }

    /*
     * Edits an event
     */
    public function getEventsEdit($id)
    {

        return View::make('events.events.edit')
            ->with('event', Pbevent::where('id', '=', $id)->first());


    }

    /*
     * Updates an event
     */
    public function postEventsUpdate($id)
    {

        // validate event
        $validation = Pbevent::validateEventUpdate(Input::all());

        if ($validation->fails())
        {
            return Redirect::back()
                ->with('message', 'Event could not be updated!')
                ->withErrors($validation);

        } else
        {

            $event = Pbevent::find($id);
            $event->date = Input::get('date');
            $event->event = Input::get('event');
            $event->save();

            return Redirect::back()
                ->with('message', 'Event was updated!');

        }
    }

    /*
     * Deletes an event and redirects back to the create page
     */
    public function postEventsDelete($id)
    {


        //Delete the pbevents_pbteams  table
        Pbevent::find($id)->pbteams()->detach();

        //get all the  games with the event_id
        $games = Pbgame::where('pbgames_event_id', '=', $id)->get();


        // Delete the games where the event id exists
        Pbgame::where('pbgames_event_id', '=', $id)->delete();


        //Delete the cats_post records
        $ok = Pbevent::find($id)->delete();

        if ($ok)
        {
            return Redirect::route('events-create')->with('message', 'Event has been deleted.');
        } else
        {
            return Redirect::back()->with('message', 'Error deleting event');
        }
    }


    /*
     * Allows player to join an event
     */
    public function getJoinEvent($id)
    {
        $teams = Pbplayer::getPlayerTeamsWithUserId(Auth::user()->id);
        $event = Pbevent::find($id);

        if ($teams->count())
        {

            // loop the array to get only the teams
            foreach ($teams->pbteams as $team)
            {
                $player_teams[] = $team;
            }

            return View::make('events.registration.event.join')
                ->with('teams', $player_teams)
                ->with('event', $event);
        }
    }

    /*
     * Stores the team into the event
     */
    //Event id
    public function postJoinEvent($event_id)
    {
        $team_id = Input::get('team'); // team to join event

        $result = Pbplayer::joinEvent($event_id, $team_id, Auth::user()->id);


switch($result)
{
    case true:
        $message = 'team was added to the event';
        break;
    case false:

        $message = 'team is already part of the event';
        break;
}
// Redirects back to the event join page
    return Redirect::back()
        ->with('message',$message);

    }

    /*
 * Blocks teams from joining an event
 */
    public function postEventsStatus($id)
    {
        $event = Pbevent::find($id);
         $status =  $event->status;

        if($status == 0){
            $event->status = 1;
            $event->save();
        }else if($status == 1){
            $event->status = 0;
            $event->save();

        }
        return Redirect::back();

    }



    }