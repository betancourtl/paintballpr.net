<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/20/15
 * Time: 10:39 PM
 * Ide:  PhpStorm
 */

 


class Tag extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $rules = array(
    
    );
    
    // Model Bindings

    public function subtags(){
        return $this->belongsToMany('Tag','album_tags','tag_id','subtag_id')->withPivot('album_id');
    }
    
    
    

}