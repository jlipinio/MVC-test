<?php
namespace App\GuestBook\Model\Entity;

/**
 * App\GuestBook\Model\Entity\Message
 *
 * @Table(name="message")
 * @Entity
 */
class Message
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @Column(type="string", nullable=false)
     */
    protected $date;

    /**
     * @var string
     *
     * @Column(type="string", length=24, nullable=false)
     */
    protected $name;


    /**
     * @Column(type="text", nullable=false)
     */
    protected $text;

    /**
     * @PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->date = date('Y-m-d H:i:s');
    }

    public function __construct()
    {
        $this->doStuffOnPrePersist();
    }


    public function getId()
    {
        return $this->id;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setText($text)
    {
        $this->text = $text;
    }


    public function getText()
    {
        return $this->text;
    }



} 