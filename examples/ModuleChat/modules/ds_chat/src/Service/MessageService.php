<?php

namespace PrestaShop\Module\DSChat\Service;

use Doctrine\Orm\EntityManager;
use Exception;
use PrestaShop\Module\DSChat\Repository\ChatBotMessagesRepository;
use PrestaShop\Module\DSChat\Entity\DsChatBotMessages;
use PrestaShop\Module\DSChat\Repository\ChatMessagesRepository;
use PrestaShop\Module\DSChat\Repository\EmployeeRepository;
use PrestaShop\Module\DSChat\Repository\ConfigurationRepository;

class MessageService
{
    /** @var ChatBotMessagesRepository $botMsgRepo */
    private $botMsgRepo;

    /** @var ChatMessagesRepository $chatMessagesRepository */
    private $chatMessagesRepository;

    /** @var EmployeeRepository $employeeRepository */
    private $employeeRepository;

    /** @var EntityManager $em */
    private $em;

    /** @var ConfigurationRepository $configurationRepository */
    private $configurationRepository;

    /**
     * Undocumented function
     *
     * @param EntityManager $em
     * @param ChatBotMessagesRepository $botMsgRepo
     * @param ChatMessagesRepository $chatMessagesRepository
     * @param EmployeeRepository $employeeRepository
     * @param ConfigurationRepository $configurationRepository
     */
    public function __construct(
        EntityManager $em, 
        ChatBotMessagesRepository $botMsgRepo, 
        ChatMessagesRepository $chatMessagesRepository, 
        EmployeeRepository $employeeRepository,
        ConfigurationRepository $configurationRepository
        )
    {
        $this->em = $em;
        $this->botMsgRepo = $botMsgRepo;
        $this->chatMessagesRepository = $chatMessagesRepository;
        $this->employeeRepository = $employeeRepository;
        $this->configurationRepository = $configurationRepository;
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id){
    
        $message = $this->botMsgRepo->findOneBy(['id'=>$id]);
        if ($message) {
            $this->em->remove($message);
            $this->em->flush();
        } else {
            throw new Exception("No found message");
        }

    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function findAllMessages(){
        return $this->botMsgRepo->getAllByArray();
    }
    /**
     * Undocumented function
     *
     * @param string $question
     * @param string $answer
     * @return void
     */
    public function add($question, $answer){
        $botMsg = new DsChatBotMessages();
        $botMsg->setQuestion($question);
        $botMsg->setAnswer($answer);
        $this->em->persist($botMsg);
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param string $question
     * @param string $answer
     * @return void
     */
    public function edit($id, $question, $answer){
        $message = $this->botMsgRepo->findOneBy(['id'=> $id]);
        if ($message) {
            $message->setQuestion($question);
            $message->setAnswer($answer);
            $this->em->flush();
        } else {
            throw new Exception("No found message");
        }
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getEmployeeById($id){
        return $this->employeeRepository->findById($id);
    }
    /**
     * Undocumented function
     *
     * @param [type] $ownerEmail
     * @return void
     */
    public function changeOwnerChat($ownerEmail) {
        $employeer = $this->employeeRepository->findByEmail($ownerEmail);
        if (empty($employeer)) {
            throw new Exception('Not found employeer');
        }
        return $employeer;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllSumMessage(){
        return $this->chatMessagesRepository->summaryMessages();
    }
}