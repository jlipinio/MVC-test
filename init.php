<?
define('EXT', '.php');
define('EXT_TEMPLATE', '.html');
define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', realpath(dirname(__FILE__)) . DS);
define('LIB_PATH', ROOT_PATH . 'lib' . DS);
define('APP_PATH', ROOT_PATH . 'App' . DS);

define('CLASSES_DIR', 'classes');
define('MI_PATH',  ROOT_PATH . 'Mi' . DS);
define('MI_TEMPLATE_PATH',  MI_PATH . 'html' . DS);
define('MI_CLASSES_PATH',  MI_PATH . CLASSES_DIR . DS);

require_once LIB_PATH . 'Twig' . DS . 'Autoloader.php';
Twig_Autoloader::register();


require_once MI_CLASSES_PATH . "ClassLoader.php";
\Mi\ClassLoader::register();

?>