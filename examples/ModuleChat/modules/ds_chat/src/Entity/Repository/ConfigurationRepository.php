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

namespace PrestaShop\Module\DSChat\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use PDO;
use PrestaShop\Module\DSChat\Entity\DsChatBotMessages;
use PrestaShop\Module\DSChat\Entity\DsChatMessages;

/**
 * ChatMessagesRepository.
 *
 * List of messages from customers to owner of the shop
 */
class ConfigurationRepository extends EntityRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /** @var EntityManager $em */
    private $em;

    /**
     * @var string
     */
    private $databasePrefix;

    /**
     * @var string
     */
    private $table;

    /**
     * @param Connection $connection
     * @param string $databasePrefix
     */
    public function __construct(Connection $connection, $databasePrefix, EntityManager $em)
    {
        $this->connection       = $connection;
        $this->em               = $em;
        $this->databasePrefix   = $databasePrefix;
        $this->table            = $this->databasePrefix . 'configuration';
    }

    /**
     * Undocumented function
     *
     * @param [type] $name
     * @return void
     */
    public function findByName($name){
        return $this->connection->createQueryBuilder()
        ->addSelect('co.*')
        ->from($this->table, 'co')
        ->where('co.name = :name')
        ->setParameter('name', $name)->execute()->fetch() ;
    }
}
