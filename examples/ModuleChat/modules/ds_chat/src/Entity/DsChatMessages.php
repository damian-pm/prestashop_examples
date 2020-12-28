<?php
namespace PrestaShop\Module\DSChat\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PrestaShop\Module\DSChat\Entity\Repository\ChatBotMessagesRepository")
 */
class DsChatMessages
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="customer", type="integer")
     */
    private $customer;

    /**
     * @var int
     *
     * @ORM\Column(name="employee", type="integer")
     */
    private $employee;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_user", type="string", length=100)
     */
    private $ipUser;
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=100)
     */
    private $state;
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=100)
     */
    private $token;
    
    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=100)
     */
    private $owner;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_time", type="datetime")
     */
    private $addedTime;

    public function __construct()
    {
        $this->state = 'unreaded';
        $this->ipUser = '0.0.0.0';
    }
    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of state
     *
     * @return  string
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param  string  $state
     *
     * @return  self
     */ 
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }


    /**
     * Get the value of ipUser
     *
     * @return  string
     */ 
    public function getIpUser()
    {
        return $this->ipUser;
    }

    /**
     * Set the value of ipUser
     *
     * @param  string  $ipUser
     *
     * @return  self
     */ 
    public function setIpUser(string $ipUser)
    {
        $this->ipUser = $ipUser;

        return $this;
    }

    /**
     * Get the value of addedTime
     *
     * @return  \DateTime
     */ 
    public function getAddedTime()
    {
        return $this->addedTime;
    }

    /**
     * Set the value of addedTime
     *
     * @param  \DateTime  $addedTime
     *
     * @return  self
     */ 
    public function setAddedTime(\DateTime $addedTime)
    {
        $this->addedTime = $addedTime;

        return $this;
    }

    /**
     * Get the value of token
     *
     * @return  string
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of customer
     *
     * @return  int
     */ 
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set the value of customer
     *
     * @param  int  $customer
     *
     * @return  self
     */ 
    public function setCustomer(int $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get the value of employee
     *
     * @return  int
     */ 
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set the value of employee
     *
     * @param  int  $employee
     *
     * @return  self
     */ 
    public function setEmployee(int $employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get the value of owner
     *
     * @return  string
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @param  string  $owner
     *
     * @return  self
     */ 
    public function setOwner(string $owner)
    {
        $this->owner = $owner;

        return $this;
    }
}