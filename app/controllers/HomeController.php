<?php

/**
 * Created by PhpStorm.
 * User: luis betancourt
 * Date: 10/19/14
 * Time: 12:58 AM
 */
class HomeController extends BaseController {

    /*
     * Pagination for blog posts
     */
    protected $paginate = 10;

    /*
     * Controller for google webmaster tools
     */

    public function google()
    {
        return View::make('googlea9f6ccdf0e43b85f');
    }


    /*
 * Blog Page Controller
 */

    public function home()
    {

        //Get the banners
         $banners = Banner::getBanners();
         $banners =  json_decode($banners,TRUE);

        //Get all the posts with categories except sales
        $posts = Post::whereHas('cats', function ($q)
        {
            $q->where('category', '!=', 'Sales');
        })->orderBy('created_at', 'DESC')
            ->paginate($this->paginate);

        //Get all the posts
        $categories = Cat::get()->all();

        // print_r($posts);

        return View::make('index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('banners', $banners);
    }

    /*
 * Blog Page Controller with query
 */

    public function query($query = null)
    {
        $category = Cat::find($query);

        //Returns the data of a pivot table and uses the order by method
        //Notice that in order to use order by you need to write down the pivot table name
        $posts = $category->posts()->orderBy('cat_post.post_id', 'DESC')->paginate($this->paginate);

        // Get all the categories
        $categories = Cat::get()->all();

        //Get the banners
        $banners = Banner::getBanners();
        $banners =  json_decode($banners,TRUE);

        return View::make('index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('searchTerm', $category->category)
            ->with('banners',$banners);
    }
    /*
 * Blog Page Controller with query
 */

    public function searchQuery()
    {
        $search =  Input::get('search');

        //Returns the data of a pivot table and uses the order by method
        //Notice that in order to use order by you need to write down the pivot table name
         $posts = Post::where('title','LIKE','%'.$search.'%')->paginate($this->paginate);

        // Get all the categories
        $categories = Cat::get()->all();

        //Get the banners
        $banners = Banner::getBanners();
        $banners =  json_decode($banners,TRUE);

        return View::make('index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('banners',$banners);
    }

    /*
     *This is the method that shows the specific blog
     * post
     */
    public function show($id)
    {

        //Get all categories
        $categories = Cat::get()->all();


        $post = Post::all()->find($id);

        return View::make('blog.post')
            ->with('post', $post)
            ->with('categories', $categories);

    }

    /*
     *This is the method that shows the specific blog
     * post
     */
    public function contact()
    {

        return View::make('blog/contact');
    }

    /*
     *This is the method that shows the specific blog
     * post
     */
    public function about()
    {

        return View::make('blog/about');
    }

    /*
     * Methods sends you to the privacy policy page for facebook login
     */
    public function privacy()
    {
        return View::make('blog/privacy');
    }

    /*
     * PHPinfo
     */
    public function phpinfo()
    {
        return View::make('phpinfo');
    }


    ############## TEST CLASSES   #############


} // End of Class





