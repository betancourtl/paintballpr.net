<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 11/19/14
 * Time: 8:37 PM
 */
class PostsController extends BaseController {

    protected $post;

    /*
     * Pagination ammount
     */
    protected $paginate = 5;

    // get all values from the post model
    public function __construct(Post $post)
    {

        $this->post = $post;
    }


    /*
     * This method shows all the blog posts
     */
    public function getPostsAll()
    {
        //Get all the posts and sorts them by the latest day
        $posts = Post::orderBy('created_at', 'DESC')->paginate($this->paginate);

        return View::make('profile.posts.blog.show')->with('posts', $posts);
    }


    /*
    * Gets the Sales Posts **** TEST ***
    */
    public function getPostsSales()
    {

        // Return the posts from the database

        // Find the user with the ID stored in the session
        $user = User::where('id','=',Auth::user()->id)->get()->first();

       // find the posts that belong the the user that is logged in
        $posts = Post::where('user_id', '=',$user->id)->orderBy('created_at','DESC')->paginate($this->paginate);

        return View::make('/profile/posts/sales/show')
            ->with('user', $user)
            ->with('posts', $posts);
    }


    /*
     * This Method routes you to the create page
     */
    public function getPostsCreate()
    {
        //get all the categories
        $categories = Cat::get()->all();

        return View::make('profile.posts.blog.create')
            ->with('categories', $categories);
    }
    /*
     * This Method routes you to the sales create page
     */
    public function getSalesCreate()
    {
        //get all the categories
        $categories = Cat::where('category','=','Sales')->get();

        return View::make('profile.posts.sales.create')
            ->with('categories', $categories);
    }

    /*
     * This is the method that validates the post and then stores the
     * information. It also returns errors and inputs if there are vali
     * dation errors.
     */
    public function postPostsStore()
    {

        //input must be sent to validator as an array
        $imgInput = array('photo' => Input::file('photo'));

        $validateImage = Picture::validate($imgInput);

        //validate post

        $validatePost = Post::validate(Input::all());

        if ($validateImage->fails() || $validatePost->fails())
        {
            //merge errors

            $errors = $validateImage->errors();
            $errors->merge($validatePost->errors());

            return Redirect::back()
                ->withErrors($errors)
                ->withInput()
                ->withMessage('Errors');
        } else
        {
            //save file 
            $image = Input::file('photo');
            $filename = $image->getClientOriginalName();
            $tmp_name = $image->getRealPath();
            $saveFolder = 'uploads/blog_images/small/' . $filename;
            $newFilename = $this->uniqueFilename($saveFolder);

            //only use images with a 1.91:1 aspect ratio
            // minimum resolution should be 1250 x 634

            Image::make($tmp_name)
                ->resize('700', null, function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->resize(null, '700', function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/blog_images/small/' . $newFilename));

            Image::make($tmp_name)
                ->resize('1300', null, function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                 ->resize(null,'1300', function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/blog_images/large/' . $newFilename));


            // save post to database

            $post = Post::create(array
                (
                    'title'   => Input::get('title'),
                    'body'    => Input::get('body'),
                    'slug'    => $this->uniqueSlug(Input::get('title')),
                    'draft'   => '0',
                    'user_id' => Auth::user()->id

                )
            );

            $picture = Picture::create(array(
                    'filename' => $newFilename,
                    'filepath' => $saveFolder

                )
            );

            //Gets the inserted post id
            $postHasMany = Post::find($post->id); // post id

            //Post id and the picture id

            $postHasMany->pictures()->attach($picture->id);

            //Post id and Cat_id from the form
            $postHasMany->cats()->attach(Input::get('cat'));


            return Redirect::back()
                ->withMessage('Upload was successful!');


        }
    }

    /*
     * This is the method that validates the sales post and then stores the
     * information. It also returns errors and inputs if there are vali
     * dation errors.
     */
    public function postSalesStore()
    {

        //input must be sent to validator as an array
        $imgInput = array('photo' => Input::file('photo'));

        $validateImage = Picture::validate($imgInput);

        //validate post

        $validatePost = Post::validateSales(Input::all());

        if ($validateImage->fails() || $validatePost->fails())
        {
            //merge errors

            $errors = $validateImage->errors();
            $errors->merge($validatePost->errors());

            return Redirect::back()
                ->withErrors($errors)
                ->withInput()
                ->withMessage('Errors');
        } else
        {
            //save file 
            $image = Input::file('photo');
            $filename = $image->getClientOriginalName();
            $tmp_name = $image->getRealPath();
            $saveFolder = 'uploads/blog_images/small/' . $filename;
            $newFilename = $this->uniqueFilename($saveFolder);

            //only use images with a 1.91:1 aspect ratio
            // minimum resolution should be 1250 x 634

            Image::make($tmp_name)
                ->resize('700', null, function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->resize(null, '700', function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/blog_images/small/' . $newFilename));

            Image::make($tmp_name)
                ->resize('1300', null, function ($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/blog_images/large/' . $newFilename));


            // save post to database

            $post = Post::create(array
                (
                    'title'   => Input::get('type') .'-' . Input::get('title'),
                    'body'    => '<strong>'.Input::get('price').'</strong>'.' <br/> '.Input::get('body'),
                    'slug'    => $this->uniqueSlug(Input::get('title')),
                    'draft'   => '0',
                    'user_id' => Auth::user()->id

                )
            );

            $picture = Picture::create(array(
                    'filename' => $newFilename,
                    'filepath' => $saveFolder

                )
            );

            //Gets the inserted post id
            $postHasMany = Post::find($post->id); // post id

            //Post id and the picture id

            $postHasMany->pictures()->attach($picture->id);

            //Post id and Cat_id from the form
            // id of 5 is sales
            $postHasMany->cats()->attach(5);


            return Redirect::back()
                ->withMessage('Upload was successful!');


        }
    }


    /*
     * Edit post page
     */
    public function getEditBlogPost($id)
    {
        //get all the categories
        $categories = Cat::get()->all();

        //Get the post with the id
        $post = $this->post->find($id);
        if (is_null($post))
        {
            return Redirect::route('profile.posts.blog.all');
        }

        return View::make('profile.posts.blog.edit')
            ->with('post', $post)
            ->with('categories', $categories);

    }

    /*
 * Edit post page
 */
    public function getPostsSalesEdit($id)
    {
        //get all the categories
        $categories = Cat::where('category','=','Sales');

        //Get the post with the id
        $post = $this->post->find($id);
        if (is_null($post))
        {
            return Redirect::route('posts-edit-sales');
        }

        return View::make('profile.posts.sales.edit')
            ->with('post', $post)
            ->with('categories',$categories);
    }


    /*
     * Update post page
     */
    public function postPostsUpdate($id)
    {
        $input = array_except(Input::all(), '_method');
        $v = Validator::make($input, Post::$rules);

        if ($v->passes())
        {
            $post = $this->post->find($id);
            $post->update($input);

            return Redirect::route('blog-post', $id);
        } else
        {

            return Redirect::route('posts-edit', $id)
                ->withInput()
                ->withErrors($v)
                ->with('message', 'There where validation errors.');
        }
    }

    /*
     * Update sales page
     */
    public function postSalesUpdate($id)
    {
        $input = array_except(Input::all(), '_method');
        $v = Validator::make($input, Post::$salesUpdateRules);

        if ($v->passes())
        {
            $post = $this->post->find($id);
            $post->update($input);

            return Redirect::route('blog-post', $id);
        } else
        {

            return Redirect::route('posts-edit-sales', $id)
                ->withInput()
                ->withErrors($v)
                ->with('message', 'There where validation errors.');
        }
    }

    /*
     * Delete post and redirects to index
     */
    public function postPostsDestroy($id)
    {
        //Delete the images table
        $images = $this->post->find($id)->pictures()->get();

        foreach ($images as $image)
        {
            $smallImage = public_path('uploads/blog_images/small/' . $image->filename);
            $largeImage = public_path('uploads/blog_images/large/' . $image->filename);

            if (file_exists($smallImage))
            {
                unlink($smallImage);
            }

            if (file_exists($largeImage))
            {
                unlink($largeImage);
            }

        }

        //Delete the picture_post images table
        $this->post->find($id)->pictures()->detach();

        //Delete the cats_post records
        $this->post->find($id)->cats()->detach();

        //Delete the post
        $this->post->find($id)->delete();

        //Delete the images in database
        foreach ($images as $image)
        {
            Picture::where('filename', '=', $image->filename)->delete();
        }

        return Redirect::back();
    }

    /*
     * Delete post and redirects to index
     */
    public function postSalesDestroy($id)
    {
        //Delete the images table
        $images = $this->post->find($id)->pictures()->get();

        foreach ($images as $image)
        {
            $smallImage = public_path('uploads/blog_images/small/' . $image->filename);
            $largeImage = public_path('uploads/blog_images/large/' . $image->filename);

            if (file_exists($smallImage))
            {
                unlink($smallImage);
            }

            if (file_exists($largeImage))
            {
                unlink($largeImage);
            }

        }

        //Delete the picture_post images table
        $this->post->find($id)->pictures()->detach();

        //Delete the cats_post records
        $this->post->find($id)->cats()->detach();

        //Delete the post
        $this->post->find($id)->delete();

        //Delete the images in database
        foreach ($images as $image)
        {
            Picture::where('filename', '=', $image->filename)->delete();
        }

        return Redirect::back();
    }


    #################### Controller Methods ######################

    /*
 * Function returns a unique filename
 * Param 1 is the path of the filename
 * returns filename with no path
 */
    public function uniqueFilename($filename)
    {

        // check to see if file exists
        if (file_exists($filename))
        {

            //Get the path location in the string without the basename
            $pathLocation = strrpos($filename, basename($filename));

            //Get the path and cut the basename
            $path = substr($filename, 0, $pathLocation);

            //Get the base filename
            $file = basename($filename);

            //replace the spaces with dashes
            $file = str_replace(' ','-',$file);

            // find the position of the last dot
            $dot = strrpos($file, '.');

            // Get the filename without the extension
            $name = substr($file, 0, $dot);

            // get the extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            //Get the name without the last character
            $name2 = substr($name, 0, - 1);

            //save the last character
            $last = substr($name, - 1);

            //if the last character is numeric add 1
            if (is_numeric($last))
            {
                $newFilename = $path . $name2 . ($last + 1) . '.' . $ext;
                //recursively call itself
                $results = $this->uniqueFilename($newFilename);

                return basename($results);
            } else
            {

                // if the last character is not numeric then add 1
                $newFilename = $path . $name . '-1' . '.' . $ext;

                //recursively call itself
                $results = $this->uniqueFilename($newFilename);

                return basename($results);
            }

        }

        return basename($filename);
    }

    /*
     * This function checks the database for a slug
     * If it doesnt find it it inserts it returns it
     * If it is in the database it creates a new one and
     * checks again.When it finds a unique one it returns it.
     */

    public function uniqueSlug($slug)
    {
        // gets the count of slugs in the database
        $count = $this->getSlugCount($slug);

        if ($count)
        {

            //Get the slug without the last character
            $slug1 = substr($slug, 0, - 1);

            //save the last character
            $last = substr($slug, - 1);

            //if the last character is numeric add 1
            if (is_numeric($last))
            {
                //join the added number to the slug
                $newSlug = $slug1 . ($last + 1);

                //recursively call itself
                $results = $this->uniqueSlug($newSlug);

                return basename($results);
            } else
            {

                // if the last character is not numeric then add-1
                $newSlug = $slug . '-1';

                //recursively call itself
                $results = $this->uniqueSlug($newSlug);

                return basename($results);
            }

        } else
        {
            return $slug;
        }
    }


    //Returns the count of slugs in the database
    public function getSlugCount($slug)
    {

        return Post::where('slug', '=', $slug)->count();
    }


    ################## TEST CONTROLLERS ##################


}// End Of Controller