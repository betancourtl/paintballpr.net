<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 11/19/14
 * Time: 2:02 PM
 */
Class Post extends Eloquent {

    protected $guarded = array();

    public static $rules = array(
        'title' => 'required|min:2|max:50',
        'body'  => 'required|min:10|max:12000'

    );

    public static $salesRules = array(
        'title' => 'required|min:2|max:50',
        'body'  => 'required|min:10|max:7000',
        'type'  => 'required',
        'price' => 'required'

    );

    /*
     * Sales Update Form Rules
     */
    public static $salesUpdateRules = array(
        'body'  => 'required|min:10|max:3000',

    );

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    /*
     * Validates Sales post
     */
    public static function validateSales($data)
    {
        return Validator::make($data, static::$salesRules);
    }

    /*
     * Function gets the user that posted the article
     * the function name must the the table name where you want to get in this case user
     *  because posts user_id references users user_id
     */
    public function user()
    {
        //One To Many
        return $this->belongsTo('User');
    }

    /*
     * Function retrieves all the images that belong to the id of a post
     */

    public function pictures()
    {
        //many to many relationship with the pictures table
        return $this->belongsToMany('Picture');
    }

    /*
     * Retrieves the categories of the post
     */

    public function cats()
    {
        return $this->belongsToMany('Cat');
    }

    /*
     * Retrieves the comments
     */
    public function comment()
    {
        return $this->hasMany('Comment');
    }


    /*
     *  Blog functions that strips out unwanted tags
     */

    public static function strip_blog_tags($text){
        echo strip_tags($text,'<h1><h2><h3><h4><h5><h6><p><img><pre><ul><ol><li><b><i><br><blockquote><em><table><tbody><tr><td><hr><a><kbd><div><span><iframe><strong>');
    }



}