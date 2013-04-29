<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Longterm - comfortable project management',
        'defaultController'=>'guest',

	// preloading 'log' component
	'preload'=>array('log', 'clientScript'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.components.helpers.*',
                'application.components.identity.*',
            
                'ext.eoauth.*',
                'ext.eoauth.lib.*',
//                'ext.lightopenid.*',
                'ext.eauth.*',
                'ext.eauth.services.*',
	),
    
        'modules'=>array(
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'123',
            ),
        ),

	// application components
	'components'=>array(
            
            'loid' => array(
                'class' => 'ext.lightopenid.loid',
            ),
            
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),

//                    array(
//                        'class'=>'CWebLogRoute',
//                    ),
                ),
            ),  

            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'returnUrl' =>  '?r=guest/index'
            ),
		
		
            'db'=>array(
                'connectionString'=>'pgsql:dbname=longterm;host=donar.immo',
                'username' => 'inform', 
                'password' => 'l!j@cneg', 
            ),    
            
            'eauth' => array(
                'class' => 'ext.eauth.EAuth',
                'popup' => true, // Use the popup window instead of redirecting.
                'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
                'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
                'services' => array( // You can change the providers and their classes.
                    'google' => array(
                        'class' => 'GoogleOpenIDService',
                    ),                    
                    'linkedin' => array(
                        // register your app here: https://www.linkedin.com/secure/developer
                        'class' => 'LinkedinOAuthService',
                        'key' => '...',
                        'secret' => '...',
                    ),
                    'facebook' => array(
                        // register your app here: https://developers.facebook.com/apps/
                        'class' => 'FacebookOAuthService',
                        'client_id' => '444671505610698',
                        'client_secret' => 'e1982507ca85f15b57c4edd02717dafc',
                    ),                    
                ),
            ),
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);