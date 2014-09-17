<?
namespace Mi;

include_once "init.php";

Route::push('HelloWorld', 'helloworld/(<action>(<format>))',
    Array(
        'format' => '(.php|.html)',
    ))
    ->defaults(array(
        'controller' => 'text',
        'action' => 'index',
        'config' => 'config.php'
    ));

Route::push('GuestBook', 'guestbook/(<action>(<format>))',
    Array(
        'id' => '\d+',
        'format' => '(.php|.html)',
    ))
    ->defaults(array(
        'controller' => 'wall',
        'action' => 'index',
        'config' => 'config.php'
    ));

Route::run();

?>