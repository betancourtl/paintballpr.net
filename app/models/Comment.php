<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/8/14
 * Time: 3:16 PM
 * Ide:  PhpStorm
 */
class Comment extends Eloquent {

    // Properties

    protected $guarded = array();


    public static $rules = array(
        'user_id' => 'required',
        'post_id' => 'required',
        'comment' => 'required'
    );

    public static function validate($data)
    {

        return Validator::make($data, static::$rules);

    }


}