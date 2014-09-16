<?
namespace App\GuestBook\Controller;

use App\GuestBook\Model\Entity\Message;
use Mi\Component\Config;
use Mi\Component\IConfig;

use Mi\Controller;
use Mi\Exception\ControllerException;
use Mi\Exception\MiException;
use Mi\Request;

use App\GuestBook\Model\MessageModel;
use Mi\Response\DataJson;
use Mi\Response\ResponseJson;

class Wall extends Controller
{

    protected function action_index()
    {
        $model = new MessageModel($this->_config);

        if(!$this->_request->isAjax()) {
            $model->loadMessage();

            return $this->render('index', array(
                'model' => $model->data()
            ));

        } else {
            $message = new Message();
            $message->setName($this->_request->post('name'));
            $message->setText($this->_request->post('text'));

            $model->addMessage($message);

            return new ResponseJson(array(
                'model' => $model->data()
            ));

        }

    }

    protected function action_install()
    {
        $model = new MessageModel($this->_config);

        if($model->createTable())
            return $this->render('install', array(
                'model' => $model->data()
            ));
        else
            throw new ControllerException($model->message, null, $model->code);
    }

    protected function action_home()
    {
        $this->redirect(array(
            'action' => 'index',
            'vars' => ''
        ));
    }




}