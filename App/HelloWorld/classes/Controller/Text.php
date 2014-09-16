<?
namespace App\HelloWorld\Controller;

use Mi\Controller;

class Text extends Controller
{

    protected function action_index()
    {
        return $this->render('index', array(
            'text' =>  'Hello World!'
        ));
    }

}