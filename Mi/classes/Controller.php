<?
namespace Mi;

use Mi\Component\Config;
use Mi\Component\IConfig;
use Mi\Exception\MiException;

use Mi\Exception\ModelException;
use Mi\Exception\ViewException;
use Mi\Exception\ControllerException;


use Mi\Response\Response;
use Mi\Response\IResponse;
use Mi\Response\DataHtml;
use Mi\Response\DataJson;

class Controller
{
    public static function getNameAction($action)
    {
        if($action === '')
            $action = 'error';

        return "action_" . $action ;
    }

    protected $_config;

    protected $_request;
    protected $_view;

    public function __construct(IConfig $config, Request $request)
    {
        $this->_config = $config;

        $this->_request  = $request;
        $this->_view     = $this->view();
    }

    protected function before()
    {

    }

    protected function after()
    {

    }

    public function action($name = 'index')
    {
        $this->before();

        $action = Controller::getNameAction($name);
        if(method_exists($this, $action))
            $response = call_user_func(array($this, $action), null);
        else
            $this->action_error($name);

        $this->after();


        return $this->make_response($response);
    }

    protected function make_response($response)
    {
        if($response instanceof IResponse)
            return $response;

        return new Response($response, Response::HTTP_OK, new DataHtml);
    }

    protected function action_error($name)
    {
       throw new ControllerException('Not found page :name!', array(
               ':name' => $name
           ), Response::HTTP_NOT_FOUND);
    }

    protected function redirect($params)
    {
        Response::redirect($this->_request->generate_uri($params));
    }

    public function render($file, $data)
    {
        return $this->_view->render($file, $data);
    }

    public function view()
    {
        if($this->_view === null)
            $this->_view = new View($this->_config);

        return $this->_view;
    }


}