<?
namespace App\GuestBook\Model;

use Mi\Component\IConfig;
use Mi\Component\Config;
use Mi\Exception\MiException;
use Mi\Model;

use App\GuestBook\Model\Entity\Message;

use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

class MessageModel extends Model
{
    protected $_em;

    public function __construct(IConfig $config = null, $data = null)
    {
        parent::__construct($config, $data);

        $config_orm = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . DS . "Entity"), true);
        $this->_em = EntityManager::create($this->_config->data('orm'), $config_orm);
    }

    public function createTable()
    {

        try {
            $tool = new SchemaTool($this->_em);
            $classes = array(
                $this->_em->getClassMetadata(__NAMESPACE__ . '\Entity\Message')
            );

            $tool->dropSchema($classes);
            $tool->createSchema($classes);
            $this->text = "Table created!";

        } catch(ToolsException $e) {

            $this->code = $e->getCode();
            $this->message = $e->getMessage();

            return false;
        }

        return true;
    }

    public function addMessage(Message $message)
    {
        if($message !== null) {
            $this->_session->user_name = $message->getName();

            $this->_em->persist($message);
            $this->_em->flush();

            $this->_data = array("id" => $message->getId());
        }

        return $this;
    }

    public function loadMessage()
    {
        $repository = $this->_em->getRepository(__NAMESPACE__ . '\Entity\Message');

        $query = $repository->createQueryBuilder('p')
                            ->orderBy('p.date', 'DESC')
                            ->getQuery();

        try{
            $messages = $query->getResult();
        } catch (QueryException $e) {
            MiException::sendHandler($e);
        }

        $this->_data = array("messages" => $messages);

        return $this;
    }
}