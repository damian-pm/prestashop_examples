<?php

namespace PrestaShop\Module\DSChat\Service;

use DateTime;
use Doctrine\Orm\EntityManager;
use Exception;
use PrestaShop\Module\DSChat\Repository\ChatBotMessagesRepository;
use PrestaShop\Module\DSChat\Entity\DsChatMessages;

/**
 * BotService class
 */
class BotService
{
    /** @var EntityManager $em */
    private $em;

    /** @var ChatBotMessagesRepository $botMsgRepo */
    private $botMsgRepo;
    
    /**
     * Undocumented function
     *
     * @param EntityManager $em
     * @param ChatBotMessagesRepository $botMsgRepo
     */
    public function __construct(EntityManager $em, ChatBotMessagesRepository $botMsgRepo)
    {
        $this->em = $em;
        $this->botMsgRepo = $botMsgRepo;
    }
    /**
     * response variable
     *
     * @var array
     */
    private $response = [ ];
    /**
     * Undocumented function
     *
     * @param integer $length
     * @return void
     */
    public function generateToken($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Undocumented function
     *
     * @param [type] $token
     * @return void
     */
    public function validToken($token){
        if (strlen($token) != 10) {
            return false;
        }
        return true;
    }
    /**
     * Undocumented function
     *
     * @param array $responses
     * @return void
     */
    public function setMessages($responses = []){
        foreach ($responses as $res) {
            $this->response[$res['question']] = $res['answer'];
        }
        return true;
    }
    /**
     * Undocumented function
     *
     * @param string $msg
     * @return void
     */
    public function checkResponseExists($msg = ''){
        return isset($this->response[$msg]);
    }
    /**
     * Undocumented function
     *
     * @param string $msg
     * @return string
     */
    public function generateResponse($msg): string
    {
        return isset($this->response[$msg]) ? $this->response[$msg] : '';
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getStartMessage(){
        return isset($this->response['Welcome']) ? $this->response['Welcome'] : '';
    }
    /**
     * Undocumented function
     *
     * @param int $customerId
     * @param string $token
     * @param string $message
     * @return void
     */
    public function addBotMessage($customerId, $token, $message){
        $botMessage        = new DsChatMessages();
        $botMessage->setContent($this->generateResponse($message));
        $botMessage->setCustomer($customerId);
        $botMessage->setEmployee(1); // TODO : z konfiguracji id
        $botMessage->setOwner('bot');
        $botMessage->setAddedTime(new DateTime());
        $botMessage->setToken($token);
        $this->em->persist($botMessage);
        $this->em->flush();
    }

}