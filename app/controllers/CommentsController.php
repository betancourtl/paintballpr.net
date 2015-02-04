<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/8/14
 * Time: 6:26 PM
 * Ide:  PhpStorm
 */
class CommentsController extends BaseController {


    public function index()
    {

    }

    public function store()
    {

        //rules
        $v = Comment::validate(Input::all());

        if ($v->fails())
        {
            Redirect::back()
                ->withInput()
                ->withErrors($v);
        }

        Comment::create(array(
            'comment' => Input::get('comment'),
            'post_id' => Input::get('post_id'),
            'user_id' => Input::get('user_id'),
        ));

        return Redirect::back()
            ->withMessage('Comment Posted!');
    }

    public function show()
    {

    }

    public function destroy()
    {

    }

    public function edit()
    {
    }

    public function update()
    {

    }

} 