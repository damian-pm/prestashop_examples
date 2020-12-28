<?php

namespace PrestaShop\Module\DSChat\Controller;

use DateTime;
use Exception;
use PrestaShop\Module\DSChat\Entity\DsChatMessages;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\DSChat\Repository\ChatMessagesRepository;
use PrestaShop\Module\DSChat\Service\MessageService;
use \Configuration as Config;

/**
 * panelController class
 */
class panelController extends FrameworkBundleAdminController {
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function indexAction(Request $request)
    {
        global $cookie;
        if (!Config::get('DS_CHAT_MESSAGE_OWNER_ID')) {
            Config::updateGlobalValue('DS_CHAT_MESSAGE_OWNER_ID', $cookie->id_employee);
        }

        $employeeId         = Config::get('DS_CHAT_MESSAGE_OWNER_ID');
        $msgService         = $this->get('dschat_chat_message_service');
        $employee           = $msgService->getEmployeeById($employeeId);

        return $this->render('@Modules/ds_chat/src/Resources/views/index.html.twig', [ 
            'url_set_message'   => $this->generateUrl('admin_link_block_dschat_get_chat_set_message'),
            'url_get_bot_msg'   => $this->generateUrl('admin_link_block_dschat_get_chat_get_bot_message'),
            'url_del_bot_msg'   => $this->generateUrl('admin_link_block_dschat_get_chat_delete_bot_message'),
            'url_add_bot_msg'   => $this->generateUrl('admin_link_block_dschat_get_chat_add_bot_message'),
            'url_edit_bot_msg'  => $this->generateUrl('admin_link_block_dschat_get_chat_edit_bot_message'),
            'url_full_chat'     => $this->generateUrl('admin_link_block_dschat_get_full_chat'),
            'url_set_owner'     => $this->generateUrl('admin_link_block_dschat_set_owner'),
            'url_get_summary_employee'     => $this->generateUrl('admin_link_block_dschat_get_summary_employee'),
            'employee_name'     => $employee['firstname'].' '.$employee['lastname'],
            'employee_email'    => $employee['email']
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function setEmployeeOwner(Request $request){

        $ownerEmail         = $request->request->get('email');
        /** @var  MessageService $msgService */
        $msgService         = $this->get('dschat_chat_message_service');
        $res                = 'ok';
        $type               = 'success';
        $employee           = [];
        try {
            $employeer = $msgService->changeOwnerChat($ownerEmail);
            Config::updateValue('DS_CHAT_MESSAGE_OWNER_ID',  $employeer['id_employee']);
            $employee = [
                'name'  => $employeer['firstname'].' '.$employeer['lastname'],
                'email' =>  $employeer['email']
            ];
        } catch(Exception $e) {
            $res = $e->getMessage();
            $type = 'danger';
        }

        return new JsonResponse([
            'res'       => $res,
            'type'      => $type,
            'employee'  => $employee
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getChat(Request $request){

        $id             = $request->request->get('id');
        $token          = $request->request->get('token');
        $employeeId     = Config::get('DS_CHAT_MESSAGE_OWNER_ID');

        /** @var ChatMessagesRepository $chatRepo */
        $chatRepo               = $this->get('dschat_chat_messages_repo');
        $curometList            = $chatRepo->getUsersList($employeeId);
        $unloggedCustomerList   = $chatRepo->getUnlogedUsersList($employeeId);
        $conversation           = $chatRepo->getMessagesUserById($id, $token);
        $chatRepo->setReadMessagesById($id, $token);

        return new JsonResponse([
            'info'          => 'full chat',
            'users'         => array_merge($curometList, $unloggedCustomerList), // getAllChatAction
            'conversation'  => $conversation, // getChatUserAction
            'token'         => $token,
            'id'            => $id
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function setMessageToUserAction(Request $request) {
        $id         = $request->request->get('id');
        $message    = $request->request->get('message');
        $token      = $request->request->get('token');
        $ip         = $request->server->get('REMOTE_ADDR');
        $res        = 'works';
        $employeeId = Config::get('DS_CHAT_MESSAGE_OWNER_ID');
        try {
            $chatMessages = new DsChatMessages();
            $chatMessages->setContent($message);
            $chatMessages->setCustomer($id);
            $chatMessages->setEmployee($employeeId);
            $chatMessages->setIpUser($ip);
            $chatMessages->setOwner("employee");
            $chatMessages->setState("unreaded");
            $chatMessages->setToken($token);
            $chatMessages->setAddedTime(new DateTime());

            /** @var ChatMessagesRepository $chatMessageRepo */
            $chatMessageRepo      = $this->get('dschat_chat_messages_repo');
            $chatMessageRepo->add($chatMessages);
        } catch(Exception $e){
            $res = $e->getMessage();
        }

        return new JsonResponse([
            'info' => 'hello json set message',
            'res' => $res,
            'data' => ['state' => 'success']
        ]);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getBotMessages(){
        /** @var  MessageService $msgService */
        $msgService      = $this->get('dschat_chat_message_service');
        $res = $msgService->findAllMessages();

        return new JsonResponse(['type'=> 'get all', 'response' => $res]);
    }
    /**
     * Undocumented function
     * url: /admin-dev/modules/ds-chat/del-bot-message
     * @return void
     */
    public function deleteBotMessage(Request $request){
        $id = $request->request->get('id');
        /** @var  MessageService $msgService */
        $msgService      = $this->get('dschat_chat_message_service');
        $res = '';
        try {
            $msgService->delete($id);
            $res = 'success';
        } catch(Exception $e) {
            $res = $e->getMessage();
        }

        return new JsonResponse(['type' => 'delete', 'response' => $res]);
    }
    /**
     * Undocumented function
     * url: /admin-dev/modules/ds-chat/del-bot-message
     * @return void
     */
    public function addBotMessage(Request $request){
        $question       = $request->request->get('question');
        $answer         = $request->request->get('answer');
        /** @var  MessageService $msgService */
        $msgService     = $this->get('dschat_chat_message_service');
        $res            = '';
        try {
            $msgService->add($question, $answer);
            $res = 'success';
        } catch(Exception $e) {
            $res = $e->getMessage();
        }

        return new JsonResponse(['type' => 'add', 'response' => $res]);
    }
    /**
     * Undocumented function
     * url: /admin-dev/modules/ds-chat/edit-bot-message
     * @return void
     */
    public function editBotMessage(Request $request){
        $question       = $request->request->get('question');
        $answer         = $request->request->get('answer');
        $id             = $request->request->get('id') ?: 0;
        /** @var  MessageService $msgService */
        $msgService     = $this->get('dschat_chat_message_service');
        $res            = '';
        try {
            if (!$id) {
                throw new Exception("No found id");
            }
            $msgService->edit($id, $question, $answer);
            $res = 'success';
        } catch(Exception $e) {
            $res = $e->getMessage();
        }

        return new JsonResponse(['type' => 'edit', 'response' => $res]);
    }
    /**
     * Undocumented function
     * url: /admin-dev/modules/ds-chat/get-summary-messages
     * @return void
     */
    public function getSumMessagesEmployeers(Request $request){
        /** @var  MessageService $msgService */
        $msgService     = $this->get('dschat_chat_message_service');
        $res = $msgService->getAllSumMessage();
        return new JsonResponse(['type' => 'getSumMessagesEmployeers', 'response' => $res ]);
    }

}