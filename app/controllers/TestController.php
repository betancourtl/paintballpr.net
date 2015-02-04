<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 10/28/14
 * Time: 8:21 PM
 */
class TestController extends BaseController {


public function errorMessage(){
    return View::make('tests.errors');
}

}// End of class