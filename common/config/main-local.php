<?php
return [
    'components' => [
	    'production_api' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kg',
            'username' => 'kg',
            'password' => '4dm1n15tr41t0R',
            'charset' => 'utf8',
        ], 
		'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kg',
<<<<<<< HEAD
            'username' => 'kg',
            'password' => '4dm1n15tr41t0R',
            'charset' => 'utf8',
        ],
		'/* api_dbkg' => [
=======
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
		/*'api_dbkg' => [
>>>>>>> a40fe189cc5783ce725d1f41d15a0b07d92be806
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kg',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
		'dbkg' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kg',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ], */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'mail.lukison.com',
				'username'   => 'postman@lukison.com',
                'password'   => 'asd123',
				//'port' => '25',
				//'port' => '465',
				//'encryption' => 'ssl'
			],
        ]		
		/**
		  * Email Modul Sending
		  * @author ptrnov  <piter@lukison.com>
		  * @since 1.1
		*/
		/* 'mailer' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => false,
            'config'           => [
                'mailer'     => 'smtpd',
                'host'       => 'mail.lukison.com',
                'port'       => '465',
                'smtpsecure' => 'ssl',
                'smtpauth'   => false,
                'username'   => 'postman@lukison.com',
                'password'   => 'asd123',
				//'username'   => 'cG9zdG1hbg==', base64
               // 'password'   => 'YmlzYTIwMTY=',
            ],
        ],  */
    ],
];
