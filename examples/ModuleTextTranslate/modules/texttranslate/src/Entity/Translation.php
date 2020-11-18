<?php

namespace PrestaShop\Module\TextTranslate\Entity;

use Doctrine\ORM\Mapping as ORM;
use PrestaShopBundle\Translation\Constraints\PassVsprintf;

/**
 * Translation.
 *
 * @ORM\Table(
 *     indexes={@ORM\Index(name="key", columns={"domain"})},
 * )
 * @ORM\Entity(repositoryClass="PrestaShop\Module\TextTranslate\Repository\TranslationRepository")
 * @PassVsprintf
 */
class Translation
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_translation", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="PrestaShopBundle\Entity\Lang", inversedBy="translations")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id_lang", nullable=false)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="`key`", type="text", length=65500)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="translation", type="text", length=65500)
     */
    private $translation;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=80)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=32, nullable=true)
     */
    private $theme = null;
    
    public function __construct()
    {
        $this->translation = 'empty';
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @return Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $key
     *
     * @return \PrestaShopBundle\Entity\Translation
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @param string $translation
     *
     * @return \PrestaShopBundle\Entity\Translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @param Lang $lang
     *
     * @return \PrestaShopBundle\Entity\Translation
     */
    public function setLang(Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @param string $domain
     *
     * @return \PrestaShopBundle\Entity\Translation
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param $theme
     *
     * @return \PrestaShopBundle\Entity\Translation
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }
}
