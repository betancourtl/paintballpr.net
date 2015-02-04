<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '1510958372522838', // paintballpr.net app ID
            'client_secret' => '49ad2aa2cd25ca17e5ebb629ab14fce7', // paintballpr.net secret key
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),

	)

);