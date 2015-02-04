<?php

class AccountController extends BaseController {

    public function getCreate()
    {

        return View::make('account.create');
    }

    public function postCreate()
    {
        $validator = Validator::make(Input::all(),
            array(
                'email'            => 'required|max:50|email|unique:users',
                'username'         => 'required|max:20|min:3|unique:users',
                'password'         => 'required|min:6',
                'confirm_password' => 'required|same:password'
            ));
        if ($validator->fails())
        {
            // back to the form
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput();
        } else
        {
            // Get the Values
            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            //activation code
            $code = str_random(60);

            //create user
            $user = User::create(array(
                'username' => $username,
                'email'    => $email,
                'password' => Hash::make($password),
                'code'     => $code,
                'active'   => 0,
                'role_id' => 4
            ));

            // user was registered
            if ($user)
            {

                //send activation email
                Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function ($message) use ($user)
                {
                    $message->to($user->email, $user->username)
                        ->subject('activate your account');
                });

                return Redirect::route('home')
                    ->with('message', 'Your account has been created We have sent you an email to activate your account');
            }
        }// end of else
    }

    /*
     * Activates user in the database
     */
    public function getActivate($code)
    {
        $user = User::where('code', '=', $code)
            ->where('active', '=', 0);

        if ($user->count())
        {
            $user = $user->first() ;

            //update user to active state
            $user->active = 1;
            $user->code = '';

            if ($user->save())
            {
                return Redirect::route('home')
                    ->with('message', 'Your account has been activated, you can now sign in!');
            }
        }

        return Redirect::route('home')
            ->with('message', 'We could not activate your account try again later');
    }

    /*
     * Displays Sign in user page
     */

    public function getSignIn()
    {
        return View::make('account/signIn');
    }

    /*
     * Signs in a user
     */
    public function postSignIn()
    {

        $validator = Validator::make(Input::all(), array(
            'email'    => 'required|email',
            'password' => 'required'
        ));

        if ($validator->fails())
        {
            // redirect to sign in page
            return Redirect::route('account-sign-in')
                ->withErrors($validator)
                ->withInput();
        } else
        {
            //remember function
            $remember = Input::has('remember') ? true : false;

            //Attempt user sign in
            $auth = Auth::attempt(array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),

            ), $remember);

            if ($auth)
            {
                //Redirect to the intended page
                return Redirect::intended('/')
                    //greets the user with it's username
                    ->with('message','Welcome back! '.Auth::user()->username);
            } else
            {

                return Redirect::route('account-sign-in')
                    ->with('message', 'Your e-mail/password is wrong, or account not activated');
            }
        }

    }

    /*
     * Sign user out
     */

    public function getSignOut()
    {
        Auth::logout();

        return Redirect::route('home');
    }

    /*
     * Get change password
     */
    public function getChangePassword()
    {
        return View::make('account/changePassword');
    }

    /*
     * Post change Password
     */
    public function postChangePassword()
    {
        //validate password
        $validate = Validator::make(Input::all(), array(
            'old_password'         => 'required',
            'new_password'         => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password'

        ));

        if ($validate->fails())
        {
            // fails the validation
            return Redirect::route('account-change-password')
                ->withErrors($validate)
                ->with('message', 'Validation failed');
        } else
        {
            $user = User::find(Auth::user()->id);
            $old_password = Input::get('old_password');
            $new_password = Input::get('new_password');

            if (Hash::check($old_password, $user->password))
            {
                $user->password = Hash::make($new_password);

                if ($user->save())
                {
                    return Redirect::route('home')
                        ->with('message', 'Your password has been changed');
                }

            } else
            {
                return Redirect::route('account-change-password')
                    ->with('message', 'Your old password in incorrect');
            }
        }

        return Redirect::route('account-change-password')
            ->with('message', 'Your password could not be changed');
    }

    /*
     * Get forget password
     */
    public function getForgetPassword()
    {
        return View::make('account/forgetPassword');
    }

    /*
     * Post forget password
     */
    public function postForgetPassword()
    {
        //Get the input from the text field
        $email = Input::get('email');

        //Validate
        $validation = Validator::make(Input::all(), array(
            'email' => 'required|email'
        ));

        if ($validation->fails())
        {

            return Redirect::route('account-forget-password')
                ->withErrors($validation)
                ->withInput();
        } else
        {

            //check if the email shows up in the database
            $user = User::where('email', '=', $email)->get();

            if ($user->count())
            {
                // change the temp password
                $user = $user->first();

                // Save variables for the Mail method
                $code = str_random(60);
                $password = str_random(10);

                //change records in the database

                $user->code = $code;
                $user->password_temp = Hash::make($password);

                if ($user->save())
                {
                    //send password reset email
                    Mail::send('emails.auth.forgot', array(
                        'link'     => URL::route('account-recover',$code),
                        'username' => $user->username,
                        'password' => $password),
                        function ($message) use ($user)
                        {
                            $message->to($user->email, $user->username)
                                ->subject('Your new password');
                        });

                    return Redirect::route('home')
                        ->with('message', 'We have sent you a new password to your e-mail account');
                } else
                {
                    return Redirect::route('account-forget-password')
                        ->with('message', 'Error changing user password');
                }

            } else
            {
                return 'email was not found in the database';
            }
        }
    }

    /*
     * Displays the recovery code for the forgotten password.
     */
    public function getRecoverPassword($code){
        $user = User::where('code','=',$code)
            ->where('password_temp','!=','');

        if($user->count())
        {
            $user = $user->first();

            //make the password the same as the temporary password
            $user->password = $user->password_temp;

            //delete password_temp row in the database
            $user->password_temp = '';

            //delete the code row from the database
            $user->code = '';

            if($user->save()){
                return Redirect::route('home')
                    ->with('message','Your account has been recovered, You can now sign in with your password');
            }
        }
        return Redirect::route('home')
            ->with('message','Could not recover your account');

    }



    // methods

    public static function createAccount(){

    }

}// End of controller
