<?php
/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\Module\TextTranslate\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tab.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TabLangCollection
{
    /** @var ArrayCollection */
    private $tablangs;
    
    /** @var ArrayCollection */
    private $translations;
    
    public function __construct()
    {
        $this->tablangs = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Get the value of tablangs
     */ 
    public function getTablangs()
    {
        return $this->tablangs;
    }

    /**
     * Set the value of tablangs
     *
     * @return  self
     */ 
    public function setTablangs($tablangs)
    {
        $this->tablangs = $tablangs;

        return $this;
    }

    /**
     * Get the value of translations
     */ 
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set the value of translations
     *
     * @return  self
     */ 
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }
}