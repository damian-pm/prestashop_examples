<?php

namespace PrestaShop\Module\DSChat\Controller;

use DateTime;
use Exception;
use PrestaShop\Module\DSChat\Entity\DsChatMessages;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\DSChat\Repository\ChatBotMessagesRepository;
use PrestaShop\Module\DSChat\Repository\ChatMessagesRepository;

class ChatController extends FrameworkBundleAdminController {

    public function indexAction(Request $request)
    {

        return $this->render('@Modules/ds_chat/src/Resources/views/index.html.twig', [ 
    
        ]);
    }
}