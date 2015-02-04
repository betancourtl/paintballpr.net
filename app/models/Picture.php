<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 11/19/14
 * Time: 2:02 PM
 */
Class Picture extends Eloquent {

    protected $guarded = array();

    public static $rules = array(
        'photo' => 'required|image',

    );

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    /*
     *Function gets the the filenames name that belongs to the post
     */
    public function posts()
    {
        //returns values from a composite table
        return $this->belongsToMany('Post');
    }


}