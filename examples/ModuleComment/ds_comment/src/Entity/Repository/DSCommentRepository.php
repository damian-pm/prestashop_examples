<?php

namespace PrestaShop\Module\DSComment\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Connection;
use PDO;

class DSCommentRepository extends EntityRepository
{
    /**
     * @var Connection
     */
    private $connection;

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
    public function __construct(Connection $connection, $databasePrefix)
    {
        $this->connection       = $connection;
        $this->databasePrefix   = $databasePrefix;
        $this->table            = $this->databasePrefix . 'dscomment';
    }
    public function findCommentsByProduct($id_product)
    {
        $qb = $this->connection->createQueryBuilder()
            ->addSelect('c.product, c.rating, c.title, c.description, c.count_dislike, c.count_like, date_format(c.date_add, "%Y-%m-%d") date_add')
            ->addSelect('cus.firstname customer')
            ->from($this->table, 'c')
            ->leftJoin('c', $this->databasePrefix . 'customer', 'cus', 'c.customer = cus.id_customer')
            ->where('c.product = :id_product')
            ->setParameter('id_product', $id_product)
            ->orderBy('c.id', 'DESC');

        return $qb->execute()->fetchAll();
    }
    public function addCommentToProduct($id_product){

    }
}