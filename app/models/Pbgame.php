<?php

/**
 * Created by Phpstorm.
 * User: luisbetancourt
 * Date: 1/10/15
 * Time: 7:41 AM
 * Ide:  Phpstorm
 */
class Pbgame extends Eloquent {

    // Properties

    protected $guarded = array();

    protected $fillable = array();


    public static $rules = array();

    /*
     * checks that the score is correct before adding to the database
     */
    public static function Validatescores($score)
    {
        if (is_null($score) || !is_numeric($score) || empty($score))
        {
            return $score = 0;
        } elseif ($score > 100)
        {
            return $score = 100;
        } elseif
        ($score < 0
        )
        {
            return $score = 0;
        }else{

        return $score;
    }
}


}