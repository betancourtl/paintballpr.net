<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/31/15
 * Time: 5:56 PM
 * Ide:  PhpStorm
 */
class Banner extends Eloquent {

    // Properties

    protected $guarded = array();

    protected $fillable = array();


    public static $rules = array(
        'uploads'            => 'required|image',
        'banner_description' => 'required',
        'begin_date'         => 'required',
        'end_date'           => 'required'
    );

    public static $updateRules = array(
        'banner_description' => 'required',
        'begin_date'         => 'required',
        'end_date'           => 'required'
    );

    //validate New Banner
    public static function validateBanner($data)
    {
        return Validator::make($data, static::$rules);


    }

    //validate New Banner
    public static function validateBannerUpdate($data)
    {
        return Validator::make($data, static::$updateRules);


    }

    /*
     * Gets all the banners between the specified days
     */
    public static function getBanners()
    {

        $date = new DateTime;
        $timeZone = new DateTimeZone('America/Puerto_Rico');
        $date->setTimezone($timeZone);
        $todaysDate = $date->format('o-m-d'); // yyyy-mm-dd

        // Load the images that are within the dates
        $banners = Banner::where('begin_date', '<=', $todaysDate)
            ->where('end_date', '>=', $todaysDate)->get();

        if (sizeof($banners) == 0){
        // if no images are found within the dates then load the default images
        $banners = Banner::where('default_banner_image','=',1)->get();
        }

        return View::make('banners.test')
            ->with('banners', $banners);

    }


}