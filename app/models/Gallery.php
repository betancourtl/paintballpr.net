<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/20/15
 * Time: 10:39 PM
 * Ide:  PhpStorm
 */

 


class Gallery extends Eloquent {

    // Properties
    
    protected $guarded = array(
    
    );
    
    protected $fillable = array(
    
    );
    
    
    public static $galleryModelRules = array(
        'uploads' => 'required|image|max:8000'
    
    );

   // Model Bindings

 public static function validateGallery($files){
   return  Validator::make($files,static::$galleryModelRules);
 }
    public function albums(){
        return $this->belongsToMany('Album','albums_galleries','gallery_id','album_fk_id');
    }





    

}