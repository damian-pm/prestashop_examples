<?php

namespace PrestaShop\Module\TextTranslate\Controller;

use Exception;
use PrestaShop\Module\TextTranslate\Form\TabLangType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\TextTranslate\Service\TranslateService;
use Symfony\Component\HttpFoundation\JsonResponse;
use PrestaShopBundle\Entity\TabLang;

/**
 * TranslateController class
 */
class TabController extends FrameworkBundleAdminController
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        /** @var TranslateService */
        $ttService      = $this->get('texttranslate.service');
        $info           = '';
        $tabName  = $request->request->get('name') ?: '';
        if ($tabName) {
            $tab          = $ttService->getTabLangByName($tabName);
        } else {
            $tab          = new TabLang();
        }
        $form           = $this->createForm(TabLangType::class, $tab);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $id = isset($form['id_t']) ? $form['id_t']->getData() : 0;
                $ttService->createOrUpdateTab($id, $data);
                $info = 'success';
            } catch (Exception $e) {
                $info = 'fail:'.$e->getMessage();
            }
        }

        return new JsonResponse([
            'info' => $info,
            'html' => $this->renderView('@Modules/texttranslate/src/Resources/views/tabForm.html.twig', [ 
                'form' => $form->createView()
            ]),
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getAll(Request $request){
        /** @var TranslateService $ttService */
        $ttService  = $this->get('texttranslate.service');
        $result     = [];
        try {
            $result = [
                'tab_langs' => $ttService->getTabLangList(),
            ];
            $status = 'ok';
        } catch (Exception $e) {
            $status = 'Something went wrong';
        }

        return new JsonResponse([
            'status' => $status,
            'result' => $result
        ]);
    }
}