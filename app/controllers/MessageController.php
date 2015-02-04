<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/27/14
 * Time: 7:52 PM
 * Ide:  PhpStorm
 */
class MessageController extends BaseController {

    //message pagination is of 15 messages per page
    protected $pagination = 15;


    /*
     * Shows user all messages
     */
    public function getIndex()
    {

        //Find the user id
        $user_id = Auth::user()->id;

        // Find the messages sent to this user
        $messages = Message::where('user_to', '=', $user_id)->paginate();

        return View::make('messages.index')
            ->with('messages', $messages);
    }

    //sent messages - shows sent messages

    /*
     * Shows specific user message
     */
    public function getShow($id)
    {

        // guard against users looking for other users messages
        $user_id = Auth::user()->id;

        // Find the message in the database and see if it exists
        $message = Message::where('id', '=', $id)
            ->where('user_to', '=', $user_id)->get();

        // count the results
        if ($message->count())
        {
            //if results are positive grab the first message
            $message = Message::where('id', '=', $id)
                ->where('user_to', '=', $user_id)->get()->first();

            //return the message
            return View::Make('messages.show')->
            with('message', $message);
        } else
        {
            return Redirect::route('message-index');

        }
    }

    /*
     * Creates a user message
     */
    public function getCreate()
    {
        //get all the users for the data-list
        $users = User::all();

        return View::make('messages.create')
            ->with('users', $users);
    }

    /*
     * Stores a user message
     */

    public function postStore()
    {
        $v = Message::validateCreateMessage(Input::all());

        //validate that the user exists and get its id
        $user_to = Message::getUserFromUsername(Input::get('username'));
        if($user_to->count()){

        }else{
            return Redirect::route('message-create')
                ->with('message','Username does not exist')
                ->withInput();
        }

        if ($v->fails())
        {

            return Redirect::route('message-create')
                ->withInput()
                ->withErrors($v);

        } else
        {
            //insert in to the database
            Message::create(array(
                'user_from' => Auth::user()->id,
                'user_to'   => $user_to->first()->id,
                'message'   => strip_tags(Input::get('message')),
                'title'     => Input::get('title'),
                'read'      => 0
            ));

            return Redirect::route('message-index')
                ->with('message', 'Message Sent');


        }
    }

    /*
     * Reply to a users message
     */

    public function postReply()
    {

        //validate input
        $v = Message::validateReplyMessage(Input::all());

        if ($v->fails())
        {

            return Redirect::back()
                ->withErrors($v)
                ->withInput();


        } else
        {
            //insert in to the database
            Message::create(array(
                'user_from' => Auth::user()->id,
                'user_to'   => Input::get('user_to'),
                'message'   => strip_tags(Input::get('message')),
                'title'     => Input::get('title').' Re:',
                'read'      => 0
            ));

            //Redirect back
            return Redirect::route('message-index')
                ->with('message', 'Message Sent!');
        }
    }

    /*
     * Deletes a message
     */
    public function postDestroy($id)
    {
        $user_id = Auth::user()->id;

        // find messages from user and look for message id
        $message = Message::where('id', '=', $id)
            ->where('user_to', '=', $user_id)->get()->first();
        if ($message->count())
        {
            //deletes the message using the message id
            $ok = Message::find($message->id)->delete();

            // if deleted
            if ($ok)
            {
                return Redirect::Route('message-index')->
                with('message', 'Message Deleted');
            } else
            {
                return Redirect::route('message-index')
                    ->with('message', 'Error deleting message');

            }
        } else
        {
            return Redirect::route('message-index')
                ->with('message', 'Message could not be deleted because it was not found');
        }


    }


}