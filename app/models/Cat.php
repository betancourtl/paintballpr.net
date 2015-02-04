<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/2/14
 * Time: 10:36 PM
 */

class Cat extends Eloquent {

    protected $guarded;

    /*
     * This retrieves all the posts with the specific category
     */

    public function posts()
    {
        return $this->belongsToMany('Post');
    }

} // End of the class