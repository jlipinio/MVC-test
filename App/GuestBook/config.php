<?
return array(

        "model" => array(

            "orm" => array(
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'dbname' => 'guestbook',

                'user' => 'root',
                'password' => '',
            )

        ),

        "view" => array(
            "path" => "App/GuestBook/html/"
        )

);