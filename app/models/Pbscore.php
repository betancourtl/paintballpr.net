<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/10/15
 * Time: 7:41 AM
 * Ide:  PhpStorm
 */

 


class Pbscore extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
    
    );
    
    // Model Bindings

    // gets the teams that the scores belong to
    public function pbteam(){
        return $this->belongsTo('Pbteam');
    }


    
    
    

}