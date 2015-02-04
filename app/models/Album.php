<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/20/15
 * Time: 10:38 PM
 * Ide:  PhpStorm
 */
class Album extends Eloquent {

    // Properties

    protected $guarded = array();

    protected $fillable = array();


    public static $rules = array();


    public static $galleryFormRules = array(
        'album_name'        => 'required|min:3|max:40|unique:albums', // album name
        'album_date'        => 'required', // album date
        'album_description' => 'required|min:5' // album dsescription

    );

    public static $galleryDirectoryRules = array(
        'album_name'        => 'required|min:3|max:40|unique:albums',

    );

    public static function validateAlbum($files)
    {
        return Validator::make($files, static::$galleryFormRules);
    }

    public static function validateAlbumDirectory($files)
    {
        return Validator::make($files, static::$galleryDirectoryRules);
    }

    public function galleries()
    {
        return $this->belongsToMany('Gallery', 'albums_galleries', 'album_fk_id', 'gallery_id');

    }

}