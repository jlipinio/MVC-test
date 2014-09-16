<?
namespace Mi;

use Mi\Component\DataObject;

class Session extends DataObject

{
    function __construct()
    {
        if(!headers_sent())
             session_start();

        if($_SESSION === null)
            $_SESSION = array();

        $this->_data = &$_SESSION;
    }

    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }

    public function &__get( $name )
    {
        return $_SESSION[$name];
    }

    function __destruct()
    {
        session_commit();
    }

    public function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }

    public function close()
    {
        session_write_close();
    }

    public function getID()
    {
        return session_id();
    }

}