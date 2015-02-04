<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/10/15
 * Time: 7:42 AM
 * Ide:  PhpStorm
 */

 


class Pbimage extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
    
    );
    
    // Model Bindings

    // link to pbplayers
    public function pbplayers(){
        return $this->hasOne('Pbplayer','player_user_id');
    }
    
    
    

}