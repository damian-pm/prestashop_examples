<?php

use PrestaShop\Module\DSComment\Repository\DSCommentRepository;

class ds_commentFetchCommentsModuleFrontController extends ModuleFrontController
{
    public function display()
    {
        $id         = Tools::getValue('id_product');
        /** @var DSCommentRepository $prodComm */
        $prodComm   = $this->container->get('product_comment_repo');
        $comments   =  $prodComm->findCommentsByProduct($id);
  
        $this->ajaxRender(json_encode([
            'data' => [
                'id'        => $id,
                'comments'  => $comments,
            ]
        ]));
    }

}