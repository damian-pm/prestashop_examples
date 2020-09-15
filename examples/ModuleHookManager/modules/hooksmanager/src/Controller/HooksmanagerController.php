<?php

namespace PrestaShop\Module\Hooksmanager\Controller;

use Exception;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShop\Module\Hooksmanager\Entity\Hook;
use PrestaShop\Module\Hooksmanager\Form\HookType;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\Hooksmanager\Repository\HookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Hook as HookPrimary;

class HooksmanagerController extends FrameworkBundleAdminController {

    public function indexAction(Request $request)
    {
        $id         = $request->query->get('id');
        $em         = $this->getDoctrine()->getManager();
        $alert      = [];

        /** @var HookRepository $hookRepository */
        $hookRepository = $this->get('prestashop.core.admin.hook.repository');

        if ($id != null) {
            $mode   = 'edit';
            /** @var Hook $hook */
            $hook   = $hookRepository->find($id);
        } else {
            $mode   = 'add';
            $hook   = new Hook();
        }

        $form       = $this->createForm(HookType::class, $hook);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var Hook $hook */
                $newHook = $form->getData();
                if ($newHook->getId_hook()) {
                    $hookRepository->update($newHook);
                } else {
                    $em->persist($newHook);
                    $em->flush();
                }
                if ($mode === 'add') {
                    $alert = ['type' => 'success','message' => 'Hook added !!'];
                    $form  = $this->createForm(HookType::class);
                } else if ($mode === 'edit') {
                    $alert = ['type' => 'success','message' => 'Hook updated!!'];
                }
           } catch (Exception $e) {
            //    dump($e->getMessage());
                $alert = ['type' => 'danger','message' => "Error - check hook name mayby duplicated or empty"];
           }
        }

        return $this->render('@Modules/hooksmanager/src/Resources/views/hooksmanager.html.twig', [
            'form'  => $form->createView(),
            'hooks' => $hookRepository->findAll(),
            'alert' => $alert,
            'mode'  => $mode,
            'url_controller' => $this->generateUrl('admin_link_block_hooksmanager'),
            'url_controller_del' => $this->generateUrl('admin_link_block_hooksmanager_del')
        ]);
    }

    public function deleteAction(Request $request) {
        $state      = 200;
        $id         = $request->request->get('id');

        try {
            $hook = new HookPrimary($id);
            $hook->delete();
        } catch(Exception $e) {
            $state = 404;
            // dump($e->getMessage());
        }

        return new JsonResponse(array('id' => $id), $state);
    }
}