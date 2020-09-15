<?php

namespace PrestaShop\Module\Hooksmanager\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityRepository;
use PDO;

use PrestaShop\Module\Hooksmanager\Entity\Hook;

class HookRepository extends EntityRepository
{
    /** @var Connection $connection */
    private $connection;
    /**
     * @param Connection $connection
     * @param string $databasePrefix
     */
    public function __construct(Connection $connection, $dbPrefix)
    {
        $this->connection = $connection;
        $this->dbPrefix = $dbPrefix;
        $this->table = $this->dbPrefix . 'hook';
    }

    
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('h.*')
            ->from($this->table, 'h')
            ->where('h.id_hook = :id')
            ->setParameters([
                'id'=> $id
            ])
            ;

        $hook = $qb->execute()->fetchAll(PDO::FETCH_CLASS, Hook::class);
        return empty($hook) ? [] : $hook[0];
    }

    public function findAll()
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('h.*')
            ->from($this->table, 'h')
            ->orderBy('h.id_hook', 'DESC')
            ;

        return $qb->execute()->fetchAll();
    }
    
    // public function delete(Hook $hook) {
    //     $qb = $this->connection->createQueryBuilder();
    //     $id = intval($hook->getId_hook());
    //     $qb
    //         ->delete($this->table, 'h')
    //         ->andWhere('h.id_hook = :id')
    //         ->setParameters([
    //             'id' => $id
    //         ])
    //     ;
    //     $qb->execute();
    // }
    public function update(Hook $hook){
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->update($this->table, 'h')
            ->where('h.id_hook = :id_hook')
            ->set('h.name', ':name')
            ->set('h.description', ':description')
            ->set('h.position', ':position')
            ->set('h.title', ':title')
            ->setParameters([
                'id_hook'       => (int)$hook->getId_hook(),
                'name'          => $hook->getName(),
                'title'         => $hook->getTitle(),
                'description'   => $hook->getDescription(),
                'position'      => $hook->getPosition(),
            ])
        ;
        $qb->execute();
    }
}