<?php
namespace PrestaShop\Module\DSChat\Repository;

use Doctrine\ORM\EntityRepository;
use PDO;

/**
 * ChatBotMessagesRepository.
 * List of chat bot messages
 */
class ChatBotMessagesRepository extends EntityRepository
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllByArray(){
        return $this->createQueryBuilder('cbm')
            ->getQuery()
            ->getArrayResult();
    }
}
