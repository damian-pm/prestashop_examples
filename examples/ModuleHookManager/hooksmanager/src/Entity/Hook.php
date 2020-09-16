<?php

namespace PrestaShop\Module\Hooksmanager\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hookb.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Hook
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_hook", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_hook;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=true)
     */
    private $title;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /** 
     * @ORM\Column(name="position", type="integer") 
     */
    private $position;
    

    /**
     * Get the value of position
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  text
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  text  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of id_hook
     *
     * @return  int
     */ 
    public function getId_hook()
    {
        return $this->id_hook;
    }

    /**
     * Set the value of id_hook
     *
     * @param  int  $id_hook
     *
     * @return  self
     */ 
    public function setId_hook(int $id_hook)
    {
        $this->id_hook = $id_hook;

        return $this;
    }
}