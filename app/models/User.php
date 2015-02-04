<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /*
     * Protected variable guarded
     */

    protected $guarded = array();

    /*
     * Validation rules for the  user model
     */

    public static $rules = array(
        'username' => 'required|unique:users',
        'email'    => 'required|email|unique:users',
        'password' => 'required|confirmed'
    );

    /*
     * validation method
     */

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);

    }

    public function posts()
    {
        return $this->hasMany('Post');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function messages(){
        return $this->hasMany('Message');
    }

    public function pbteams(){
        return $this->hasOne('Pbteam');
    }

}
