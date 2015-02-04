<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 10:04 PM
 * Ide:  PhpStorm
 */

 


class Pbrole extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
    
    );
    
    // Model Bindings
    public function pbroles(){
        return $this->hasOne('Pbplayer');

    }
    
    
    

}