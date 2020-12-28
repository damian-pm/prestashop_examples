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
class EmployeeRepository extends EntityRepository
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
     * Undocumented function
     *
     * @param Connection $connection
     * @param string $databasePrefix
     * @param EntityManager $em
     */
    public function __construct(Connection $connection, $databasePrefix, EntityManager $em)
    {
        $this->connection       = $connection;
        $this->em               = $em;
        $this->databasePrefix   = $databasePrefix;
        $this->table            = $this->databasePrefix . 'employee';
    }
    /**
     * Undocumented function
     *
     * @param int $employeeId
     * @return void
     */
    public function findById($employeeId){
        $qb = $this->connection->createQueryBuilder()
        ->addSelect('em.*')
        ->from($this->table, 'em')
        ->andWhere('em.id_employee = :employeeId')
        ->setParameter('employeeId', $employeeId) ;
        $res = $qb->execute()->fetchAll();
    return count($res) ? $res[0] : [];
    }
    /**
     * Undocumented function
     *
     * @param string $email
     * @return void
     */
    public function findByEmail($email) {
        $qb = $this->connection->createQueryBuilder()
        ->addSelect('em.*')
        ->from($this->table, 'em')
        ->andWhere('em.email = :email')
        ->setParameter('email', $email);
        
        $res = $qb->execute()->fetchAll();
        return count($res) ? $res[0] : [];
    }
}
