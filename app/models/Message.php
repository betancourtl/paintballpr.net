<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/30/14
 * Time: 7:59 PM
 * Ide:  PhpStorm
 */


class Message extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    //Reply Message Rules
    public static $rules = array(
        'title' => 'required|min:5',
        'message' => 'required|min:10',
        'user_to' => 'required|numeric'
    );

    //Create Message Rules
    public static $createRules = array(
        'title' => 'required|min:5',
        'message' => 'required|min:10',
        'username' => 'required'
    );

    // Model Bindings
    public function Users(){
        return $this->belongsTo('User');
    }

    // validation function
    public static function validateReplyMessage($input){
        return Validator::make($input,static::$rules);
    }

    // validation of a new message function
    public static function validateCreateMessage($input){
        return Validator::make($input,static::$createRules);
    }

    //retrieves the user object using a username
    public static function getUserFromUsername($username){
        return User::where('username','=',$username)->get();
    }

    //return user information
    public static function getUserFromId($user_id){
        $user = User::where('id','=',$user_id)->get()->first();
        return $user;
    }

}