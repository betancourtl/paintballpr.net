<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/31/15
 * Time: 4:27 PM
 * Ide:  PhpStorm
 */
class BannersController extends BaseController {


    protected $paginate = 12; // 12 albums per page
    protected $paginateTen = 10; // 10 per page


    /*
     * test
     */

    public function getTest(){
        $date = new DateTime;
        $timeZone = new DateTimeZone('America/Puerto_Rico');
        $date->setTimezone($timeZone);
        $todaysDate = $date->format('o-m-d');


        $banners = Banner::
        where('begin_date','<=',$todaysDate)
        ->where('end_date','>=',$todaysDate)->get();

        return View::make('banners.test')
            ->with('banners',$banners);

    }
    /*
     * Show main banner page
     */
    public function getIndex()
    {

        $banners = Banner::orderBy('created_at', 'DESC')->get();

        return View::make('banners.index')
            ->with('banners', $banners);
    }

    /*
     * Shows 1 Banner
     */
    public function getShow($id)
    {
        return View::make('banners.show');

    }

    /*
     * Page to upload banners
     */
    public function getCreate()
    {
        return View::make('banners.create');

    }

    /*
     * banner update page
     */
    public function postUpdate($id)
    {

        $validation = Banner::validateBannerUpdate(Input::all());
        if ($validation->fails())
        {

            return Redirect::back()
                ->withErrors($validation)
                ->withInput();

        } else
        {
            $banner = Banner::where('id', '=', $id)->first();

            $banner->banner_description = Input::get('banner_description');
            $banner->begin_date = Input::get('begin_date');
            $banner->end_date = Input::get('end_date');
            $banner->default_banner_image = 0; // 0 means that the image is not a default image
            //default images are loaded when no other images are found

            $banner->save();


            return Redirect::back()
                ->with('message', 'Banner updated');

        }

    }

    /*
     * page to destroy banners
     */
    public function postDestroy($id)
    {
        $banner = Banner::where('id', '=', $id)->first();
        $albumPath = 'images/banners/1200x300/'; // Banner folder path

        unlink($albumPath.$banner->banner_name);
        $banner->delete();

        return Redirect::back()
            ->with('message', 'Banner was deleted');

    }

    /*
     * page to edit banners
     */
    public function getEdit($id)
    {
        $banner = Banner::where('id', '=', $id)->first();

        return View::make('banners.edit')
            ->with('banner', $banner);


    }

    /*
    * Stores a banner
    */
    public function postStore()
    {
        //get the upload files
        $upload = Input::file('uploads');

        //validate the inputs
        $validation = Banner::validateBanner(Input::all());

        //validate the upload

        if ($validation->fails())
        {

            return Redirect::back()
                ->withErrors($validation)
                ->withInput();

        } else
            // validate the image size

            //validate the width and the height of the image
            $size = getimagesize($upload->getRealPath()); //temporary path of image

        $width = $size[0];
        $height = $size[1];

        if ($width != 1000 || $height != 300)
        {
            return Redirect::back()
                ->withErrors($validation)
                ->withInput()
                ->with('message', 'Image must be of size 1000 X 300  your image is ' . $width . ' X ' . $height);

        }

        {
            //get the album path
            $albumPath = 'images/banners/1200x300/'; // Banner folder path


            // creates a unique filename
            $filename = $upload->getClientOriginalName(); // original filename
            $tmp_name = $upload->getRealPath(); //temporary path of image
            $imagePath = $albumPath . $filename; // path where the image is going to be saved along with the filename

            //makes sure that the filename does not exist in the banners folder
            $newFilename = $this->uniqueFilename($imagePath);

            $newImagePath = $albumPath . $newFilename; // small image path with new filename

            Image::make($tmp_name)
                ->fit(1000, 300, function ($constraint)
                {
                    $constraint->aspectRatio();
                })
                ->save($newImagePath);

            Banner::create(array(
                'banner_description' => Input::get('banner_description'),
                'begin_date'         => Input::get('begin_date'),
                'end_date'           => Input::get('end_date'),
                'banner_name'        => $newFilename
            ));

            return Redirect::back()
                ->with('message', 'banner was uploaded');

        }
    }

    /*
* Function returns a unique filename
* Param 1 is the path of the filename
* It also checks that the path where is going to be saved exists
* returns filename with no path
*/
    public function uniqueFilename($filename)
    {
        //get all the files from the database

        // check to see if file exists
        if (file_exists($filename))
        {

            //Get the path location in the string without the basename
            $pathLocation = strrpos($filename, basename($filename));

            //Get the path and cut the basename
            $path = substr($filename, 0, $pathLocation);

            //Get the base filename
            $file = basename($filename);

            // replace the spaces with dashes
            $file = str_replace(' ', '-', $file);

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


}// end of class

