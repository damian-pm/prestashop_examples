<?php

use PrestaShop\Module\DSChat\Repository\ChatMessagesRepository;
use PrestaShop\Module\DSChat\Service\BotService;
use \Configuration as Config;

/**
 * ChatGetUserText class
 * call: /pl/module/ds_chat/chatGetText
 */
class ds_chatGetMessagesModuleFrontController extends ModuleFrontController
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function display()
    {
        /** @var BotService $bot */
        $bot            = $this->container->get('dschat_chat_bot_service');
        /** @var ChatMessagesRepository $chatRepo */
        $chatRepo       = $this->container->get('dschat_chat_messages_repo');
        $chatBotRepo    = $this->container->get('dschat_chat_bot_messages_repo');
        $botMsgs        = $chatBotRepo->getAllByArray();

        $customerId     = $this->context->customer->id ?: 0;
        $token          = Tools::getValue('token') ?: '';
        $employeeId     = Config::get('DS_CHAT_MESSAGE_OWNER_ID');
        $error          = '';

        if (!$bot->validToken($token)) {
            $token = $bot->generateToken();
        }
        $messages       = $chatRepo->getMessagesUserById($customerId, $token);
        $lastMsg        = end($messages);

        if (!$employeeId) {
            // Set employee in configuration ds_chat module
            $error = 'Chat temporary blocked';
        } else if ($lastMsg['owner'] == 'customer') {
            $bot->setMessages($botMsgs);
            if ($bot->checkResponseExists($lastMsg['message'])) {
                $bot->addBotMessage($customerId, $token, $lastMsg['message']);
            }
        } else if (count($messages) == 0 ) {
            $bot->setMessages($botMsgs);
            // Check bot message got row with question=BOT_START_MESSAGE
            if ($bot->checkResponseExists('BOT_START_MESSAGE')) {
                $bot->addBotMessage($customerId, $token, 'BOT_START_MESSAGE');
            }
        }

        $this->ajaxRender(json_encode([
            'type'  => 'get all messages customer',
            'token' => $token,
            'data'  => $messages,
            'error' => $error
        ]));
    }
}