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

use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use PDO;
use PrestaShop\Module\DSChat\Entity\DsChatMessages;

/**
 * ChatMessagesRepository.
 *
 * List of messages from customers to owner of the shop
 */
class ChatMessagesRepository extends EntityRepository
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
     * @param [type] $databasePrefix
     * @param EntityManager $em
     */
    public function __construct(Connection $connection, $databasePrefix, EntityManager $em)
    {
        $this->connection       = $connection;
        $this->em               = $em;
        $this->databasePrefix   = $databasePrefix;
        $this->table            = $this->databasePrefix . 'ds_chat_messages';
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param string $token
     * @return void
     */
    public function getMessagesUserById($id, $token = '')
    {
        if (!$id && !$token) {
            return [];
        }
        $qb = $this->connection->createQueryBuilder()
            ->addSelect('cm.id, cm.content message, cm.ip_user, cm.state, date_format(cm.added_time, "%Y-%m-%d %H:%i") added_time, 
            CONCAT(c.firstname, " ", c.lastname) customer, CONCAT(em.firstname, " ", em.lastname) employee,
            cm.owner
            ')
            ->from($this->table, 'cm')
            ->leftJoin('cm', $this->databasePrefix . 'customer', 'c', 'cm.customer = c.id_customer')
            ->leftJoin('cm', $this->databasePrefix . 'employee', 'em', 'cm.employee = em.id_employee');
        $qb->where('cm.customer = :id')->setParameter('id', $id);
        if ($id == 0 && $token) {
            $qb->where('cm.token = :token')->setParameter('token', $token);
        }
        $qb->orderBy('cm.id', 'ASC');

        return $qb->execute()->fetchAll();
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param string $token
     * @return void
     */
    public function setReadMessagesById($id, $token = ''){
        if (!$id && !$token) {
            return [];
        }
        $sql = 'UPDATE '.$this->table.' SET state="readed" where customer='.$id;
        if ($id == 0 && $token) {
            $sql .= ' AND token="'.$token.'"';
        }
        $this->connection->prepare($sql)->execute();
    }
    /**
     * Undocumented function
     *
     * @param integer $employeeId
     * @return void
     */
    public function getUsersList($employeeId = 0) {

        $qb = $this->connection->createQueryBuilder()
            ->addSelect('cm.customer id, CONCAT(c.firstname, " ", c.lastname) name, COUNT(cm.customer) as countMessage, cm.token,
            sum(case when cm.state = "unreaded" then 1 else 0 end) as unreaded_count')
            ->from($this->table, 'cm')
            ->leftJoin('cm', $this->databasePrefix . 'customer', 'c', 'cm.customer = c.id_customer')
            ->leftJoin('cm', $this->databasePrefix . 'employee', 'em', 'cm.employee = em.id_employee')
            ->where('cm.customer != 0')
            ->andWhere('cm.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->groupBy('cm.customer')
            ->orderBy('cm.id', 'DESC');

        return $qb->execute()->fetchAll();
    }
    /**
     * Undocumented function
     *
     * @param integer $employeeId
     * @return void
     */
    public function getUnlogedUsersList($employeeId = 0) {

        $qb = $this->connection->createQueryBuilder()
            ->addSelect('cm.customer id, CONCAT(c.firstname, " ", c.lastname) name, COUNT(cm.customer) as countMessage, cm.token, 
            sum(case when cm.state = "unreaded" then 1 else 0 end) as unreaded_count')
            ->from($this->table, 'cm')
            ->leftJoin('cm', $this->databasePrefix . 'customer', 'c', 'cm.customer = c.id_customer')
            ->leftJoin('cm', $this->databasePrefix . 'employee', 'em', 'cm.employee = em.id_employee')
            ->groupBy('cm.token')
            ->where('cm.customer = 0')
            ->andWhere('cm.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->orderBy('cm.id', 'DESC');

        return $qb->execute()->fetchAll();
    }
    /**
     * Undocumented function
     *
     * @param DsChatMessages $chatMessages
     * @return void
     */
    public function add(DsChatMessages $chatMessages){
        $this->em->persist($chatMessages);
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function summaryMessages(){
        $qb = $this->connection->createQueryBuilder()
            ->addSelect(' CONCAT(em.firstname, " ", em.lastname) name, COUNT(cm.employee) as count, em.email')
            ->from($this->table, 'cm')
            ->rightJoin('cm', $this->databasePrefix . 'employee', 'em', 'cm.employee = em.id_employee')
            ->groupBy('cm.employee')
            ->orderBy('cm.id', 'DESC');
        return $qb->execute()->fetchAll();
    }
}
