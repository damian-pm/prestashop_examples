<?php

namespace PrestaShop\Module\TextTranslate\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TabLang.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PrestaShop\Module\TextTranslate\Repository\TabLangRepository")
 */
class TabLang
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PrestaShopBundle\Entity\Tab")
     * @ORM\JoinColumn(name="id_tab", referencedColumnName="id_tab", nullable=false)
     */
    private $tab;

    /**
     * @ORM\ManyToOne(targetEntity="PrestaShopBundle\Entity\Lang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id_lang", nullable=false, onDelete="CASCADE")
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;


    /**
     * Set name.
     *
     * @param string $name
     *
     * @return TabLang
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lang.
     *
     * @param \PrestaShopBundle\Entity\Lang $lang
     *
     * @return TabLang
     */
    public function setLang(Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang.
     *
     * @return \PrestaShopBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }



    /**
     * Get the value of tab
     */ 
    public function getTab()
    {
        return $this->tab;
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }
}
