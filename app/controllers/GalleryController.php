<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/19/15
 * Time: 8:12 PM
 * Ide:  PhpStorm
 */
class GalleryController extends BaseController {

    protected $paginate = 12; // 12 albums per page
    protected $paginateTen = 10; // 10 per page


    /*
     * Show main gallery page
     */
    public function getIndex()
    {
        //Get all the albums and paginate it
        $albums = Album::with('Galleries')->orderBy('created_at', 'DESC')->paginate($this->paginate);

        return View::make('gallery.index')
            ->with('albums', $albums);

    }

    /*
     * Shows 1 album
     */
    public function getShow($id)
    {
        $album = Album::where('id', '=', $id)->with('Galleries')->first();

        return View::make('gallery.show')
            ->with('album', $album);

    }

    /*
     * Page to upload images
     */
    public function getCreate()
    {

        // Get all the albums
        //Get all the albums and paginate it
        $albums = Album::with('Galleries')->orderBy('created_at', 'DESC')->paginate($this->paginateTen);

        //get all the tags
        $tags = Tag::where('tag', '=', 'photo')->first();

        //get all the subtags
        $subtags = Subtag::all();

        return View::make('gallery.create')
            ->with('tags', $tags)
            ->with('subtags', $subtags)
            ->with('albums', $albums);
    }

    /*
     * PostUpdate
     */
    public function postUpdate($id)
    {
        return Redirect::back();
    }

    /*
     * page to destroy images
     */
    public function postDestroy($id)
    {
        //get the album with the images
        $album = Album::where('id', '=', $id)->with('galleries')->first();

        //get all the images in an array
        $allImages = $album->galleries;
        foreach ($allImages as $filename)
        {
            // image array
            $image_filename[] = $filename->gallery_filename;
            $image_id[] = $filename->id;
        }
        //get the album name
        $album_name = $album->album_name;

        //delete all the images from the album in the server
        $mainFolder = $imageFolderSmall = public_path('/gallery/albums/' . $album->album_name); // get the main folder
        $imageFolderSmall = $mainFolder . '/small/'; //define the small images folder
        $imageFolderLarge = $mainFolder . '/large/'; //define the large images folder

        // check to see if the directory exists if not then skip the delete folder process

        foreach ($image_filename as $file)
        { //loop each image file

            //removes image files from server
            unlink($imageFolderSmall . $file); //remove small images from the folder
            unlink($imageFolderLarge . $file); //remove large images from the folder
        }
        rmdir($imageFolderSmall);
        rmdir($imageFolderLarge);
        rmdir($mainFolder);


        //delete all the images from the database
        foreach ($image_id as $file_id)
        {

            $album->galleries()->detach($file_id); //deletes the pivot table
            Gallery::where('id', '=', $file_id)->first()->delete(); // deletes image
        }

        //delete album_galleries entries from the database
        DB::table('album_tags')->where('album_id', '=', $album->id)->delete();


        //delete the albums from the databse
        $album->delete($album->id);


        //get all the tags
        $tags = Tag::where('tag', '=', 'photo')->first();

        //get all the subtags
        $subtags = Subtag::all();

        $albums = Album::with('Galleries')->orderBy('created_at', 'DESC')->paginate($this->paginateTen);


        //delete the album tags from the database
        $message = 'Album was successfully deleted';

        return Redirect::back()->with('message', $message);
    }

    /*
     * page to edit images
     */
    public function getEdit($id)
    {
        return View::make('gallery.index');
    }


    /*
 * Stores an album
 */
    public function postStore()
    {
        //get the tags
        $tags = Input::get('tags');

        //get the subtags
        $subtags = Input::get('subtags');

        // check for the max file uploads
        $uploadCount = sizeof(Input::file('uploads')); // uploaded files count
        $uploadMax = 101; // maximum files to upload
        $uploadMaxSize = 125000000; // upload max size 125MB
        $uploadSize = $_SERVER['CONTENT_LENGTH'];//$_Files total size

        //Validations

        if ($uploadSize > $uploadMaxSize)
        {
            $message = 'Total upload size must be less than ' . $uploadMaxSize / 1000000 . ' MB'
                . ' you tried to upload ' . round($uploadSize / 1000000, 1) . ' MB';

            return Redirect::back()
                ->with('message', $message)
                ->withInput();
        }

        if ($uploadCount > $uploadMax)
        {
            $message = 'You can\'t upload more than' . $uploadMax . ' files';

            return Redirect::back()
                ->with('message', $message)
                ->withInput();

        }

        if (sizeof($subtags) == 0 || sizeof($tags) == 0)
        {
            $message = 'You must choose 1 tag and 1 or more subtags';

            return Redirect::back()
                ->with('message', $message)
                ->withInput();

        }

        $validateAlbum = Album::validateAlbum(Input::all()); // validate the album without dashes
        $directory = str_replace(' ', '-', Input::get('album_name')); // validate album with dashes

        $validateAlbum2 = Album::validateAlbumDirectory(array('album_name' => $directory));

        if ($validateAlbum->fails() || $validateAlbum2->fails())
        {

            //merge errors
            $errors = $validateAlbum->errors();
            $errors = $errors->merge($validateAlbum2->errors());

            return Redirect::back()
                ->withErrors($errors)
                ->withInput();
        }

        $uploads = Input::file('uploads');

        foreach ($uploads as $upload)
        {
            $upload = array('uploads' => $upload);// upload must be an array

            // validate the uploaded file
            $validateGallery = Gallery::validateGallery($upload);

            //if the validation fails then redirect back to the create page
            if ($validateGallery->fails())
            {
                return Redirect::back()
                    ->withErrors($validateGallery)
                    ->withInput();
            }

        }

        // Create a directory with the album name
        $album_name = str_replace(' ', '-', Input::get('album_name')); // Album name - replaces spaces with dashes

        $albumPath = 'gallery/albums/' . $album_name; // New Small album path

        $albumPathSmall = 'gallery/albums/' . $album_name . '/small/';
        $albumPathLarge = 'gallery/albums/' . $album_name . '/large/';

        mkdir(public_path($albumPath)); // new small album

        mkdir(public_path($albumPathSmall)); // new small album
        mkdir(public_path($albumPathLarge)); // new large album


        // Insert album information into the database

        $album = Album::create(array(
            'album_name'        => $album_name,// name with spaces replaced
            'album_description' => Input::get('album_description'),
            'album_date'        => Input::get('album_date')
        ));


        //Upload all the images into the database
        foreach ($uploads as $upload)
        {
            // creates a unique filename
            $filename = $upload->getClientOriginalName(); // original filename
            $tmp_name = $upload->getRealPath(); //temporary path of image
            $imagePathSmall = $albumPathSmall . $filename; // path where the image is going to be saved along with the filename

            //makes sure that the filename does not exist in the small image folder
            $newFilename = $this->uniqueFilename($imagePathSmall);
            //makes sure that the new filename does not exist in the large folder
            $newFilename = $this->uniqueFilename($albumPathLarge . $newFilename);
            // Upload Small image files to the server

            $smallImagePath = $albumPathSmall . $newFilename; // small image path with new filename
            $largeImagePath = $albumPathLarge . $newFilename; // large image path with new filename

            Image::make($tmp_name)
                ->resize(null, 300, function ($constraint)
                {
                    $constraint->aspectRatio();
                })->widen(400, function ($constraint)
                {
                    $constraint->upsize();
                })
                ->save($smallImagePath);

            // Upload Large Files to the server
            Image::make($tmp_name)
                ->resize(null, 600, function ($constraint)
                {
                    $constraint->aspectRatio();
                })
                ->save($largeImagePath);


            // fill the gallery table with the gallery id
            $gallery = Gallery::create(array(
                'gallery_filename' => $newFilename // gets the original filename
            ));

            // fill the pivot table with the album id and the gallery id
            Album::find($album->id)->galleries()->attach($gallery->id);

        }

        // fill the pivot album_tags pivot table
        foreach ($tags as $tag)
        {
            //Raw query
            foreach ($subtags as $subtag)
            {
                DB::table('album_tags')->insert(
                    array('tag_id' => $tag, 'subtag_id' => $subtag, 'album_id' => $album->id)
                );

            }
        }

        return Redirect::route('gallery-create')->with('message', 'Upload Complete!');


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