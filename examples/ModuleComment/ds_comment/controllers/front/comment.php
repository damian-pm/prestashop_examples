<?php

use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\DSComment\Entity\DSComment;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormError;

require_once _PS_ROOT_DIR_.'/app/AppKernel.php';

class ds_commentCommentModuleFrontController extends ModuleFrontController
{
    public function initContainer($request){
        $kernel             = new \AppKernel('dev', true);
        $kernel->boot($request);
        $this->container    = $kernel->getContainer();
    }

    public function display()
    {
        $request        = new Request();
        $customerId     = (int) $this->context->cookie->__get('id_customer');
        $info           = [];
        $data           = Tools::getAllValues();
        $productId      = Tools::getValue('id_product');

        $this->initContainer($request);
        /** @var EntityManager $em */
        $em             = $this->container->get('doctrine.orm.entity_manager');
        $prodComm       = $this->container->get('product_comment_repo');
        $comments       =  $prodComm->findCommentsByProduct($productId);
        $comment        = new DSComment();

        if (!$customerId) { // Check user is logged
            $this->ajaxRender(json_encode([
                'data' => [
                    'html'      => '',
                    'comments'  => $comments,
                    'info'     => [
                        ['type' => 'alert-danger', 'message' => 'Please login!']
                    ],
                    'log' => [isset($data['comment']) , $customerId , $productId]
                ]
            ]));
            return;
        }

        if (isset($data['comment'])) {
            $comment->setTitle($data['comment']['title']);
            $comment->setDescription($data['comment']['description']);
            $comment->setRating($data['comment']['rating']);
        }
        /** @var Form $form */
        $form       = $this->container->get('form.factory')
            ->create('PrestaShop\Module\DSComment\Form\CommentType', $comment);

        if (isset($data['comment']) && $customerId && $productId) {
            $comment->setProduct($productId);
            $comment->setCustomer($customerId);
            $form = $this->addComment($em, $form, $comment);
        }

        $html = $this->container->get('templating')
            ->render('@Modules/ds_comment/src/Resources/views/form.html.twig',[
                'form' => $form->createView(),
        ]);

        $this->ajaxRender(json_encode([
            'data' => [
                'html'      => $html,
                'comments'  => $comments,
                'info'     => $info
            ],
            'test' => 'hellooo'
        ]));
    }
    /**
     * Validation form
     *
     * @param [type] $em
     * @param [type] $form
     * @param DSComment $comment
     * @return void
     */
    public function addComment($em, $form, DSComment $comment){
        
        if ($comment->getTitle() == '') {
            $form->get('title')->addError(new FormError('Write title'));
        }
        if (strlen($comment->getDescription()) < 3) {
            $form->get('description')->addError(new FormError('Description too short -  min 3 chars'));
        }

        if ((string)$form->getErrors(true, false) == '') {
            $em->persist($comment);
            $em->flush();
        }

        return $form;
    }
}