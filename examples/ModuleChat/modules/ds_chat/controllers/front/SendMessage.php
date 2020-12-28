<?php

// use PrestaShop\Module\DSComment\Repository\DSCommentRepository;

use PrestaShop\Module\DSChat\Entity\DsChatMessages;
use \Configuration as Config;
/**
 * SendMessage class
 * call: /pl/module/ds_chat/SendMessage
 */
class ds_chatSendMessageModuleFrontController extends ModuleFrontController
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function display()
    {
        /** @var EntityManager $em */
        $em             = $this->container->get('doctrine.orm.entity_manager');

        $error          = '';
        $token          = Tools::getValue('token') ?: '';
        $message        = Tools::getValue('message') ?: '';
        $ip             = '0.0.0.0';
        $customerId     = $this->context->customer->id ?: 0;
        $employeeId     = Config::get('DS_CHAT_MESSAGE_OWNER_ID');

        try {
            if (!$employeeId) {
                // Set employee in configuration module ds_chat
                throw new Exception('Chat temporary blocked');
            }
            $chatMessage        = new DsChatMessages();
            $chatMessage->setContent($message);
            $chatMessage->setCustomer($customerId);
            $chatMessage->setEmployee($employeeId); // TODO : z konfiguracji id
            $chatMessage->setOwner('customer');
            $chatMessage->setAddedTime(new DateTime());
            $chatMessage->setToken($token);
            $chatMessage->setIpUser($ip);
            $em->persist($chatMessage);
            $em->flush();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        $this->ajaxRender(json_encode([
            'error' => $error,
        ]));
    }
}