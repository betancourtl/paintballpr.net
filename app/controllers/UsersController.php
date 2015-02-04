<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/1/14
 * Time: 9:09 PM
 */
class UsersController extends BaseController {

    protected $users;

    /*
     * Constructor that get all the users
     */

    public function __construct(User $users)
    {

        //Protect this from unauthorized users

        $this->users = $users;
    }

    /*
     *  Resource route
     */
    public function index()
    {

        $users = $this->users->all();

        return View::make('admin.users.index')->with('users', $users);

    }

    /*
     *  Resource route
     */
    public function create()
    {

    }

    /*
     *  Resource route
     */
    public function store()
    {

    }

    /*
     *  Resource route
     */
    public function show($id)
    {

        $user = $this->users->findOrFail($id);

        return View::make('admin.users.show')->with('user', $user);


    }

    /*
     *  Resource route
     */
    public function edit()
    {

    }

    /*
     *  Resource route
     */
    public function update()
    {

    }

    /*
     *  Resource route
     */
    public function destroy()
    {

    }


}