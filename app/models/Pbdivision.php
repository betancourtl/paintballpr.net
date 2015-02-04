<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/10/15
 * Time: 7:40 AM
 * Ide:  PhpStorm
 */

 


class Pbdivision extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
    
    );
    
    // Model Bindings

    // link to pbteams
    public function pbdivisions(){
        return $this->hasOne('Pbteam');
    }
    
    
    

}