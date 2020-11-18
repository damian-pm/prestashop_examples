<?php

namespace PrestaShop\Module\TextTranslate\Controller;

use Exception;
use PrestaShop\Module\TextTranslate\Form\TranslationAddType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\TextTranslate\Service\TranslateService;
use Symfony\Component\HttpFoundation\JsonResponse;
use PrestaShopBundle\Entity\Translation;

/**
 * TranslateController class
 */
class TranslateController extends FrameworkBundleAdminController
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function indexAction(Request $request)
    {
        return $this->render('@Modules/texttranslate/src/Resources/views/index.html.twig', [ 
            'url_clear_cache' => $this->generateUrl('admin_clear_cache'),
            'url_get_translations' => $this->generateUrl('translator_text_get_translations'),
            'url_get_tabs' => $this->generateUrl('translator_text_get_tab'),
            'url_update_translation' => $this->generateUrl('translator_text_update_translation'),
            'url_delete_translation' => $this->generateUrl('translator_text_delete_translation'),
            'url_update_tabs' => $this->generateUrl('translator_text_update_tab'),
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function updateTranslationAction(Request $request){
        /** @var TranslateService */
        $ttService      = $this->get('texttranslate.service');
        $info           = '';
        $translationId  = $request->request->get('id') ?: 0;
        if ($translationId) {
            $trans          = $ttService->getCustomeTranslationById($translationId);
        } else {
            $trans          = new Translation;
        }
        $form           = $this->createForm(TranslationAddType::class, $trans);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var Translation $data*/
                $data = $form->getData();
                $id = isset($form['id']) ? (int)$form['id']->getData() : 0;
                $ttService->createOrUpdate($id, $data);
                $info = 'success';
            } catch (Exception $e) {
                $info = 'fail:'.$e->getMessage();
            }
        }

        return new JsonResponse([
            'info' => $info,
            'html' => $this->renderView('@Modules/texttranslate/src/Resources/views/formTranslation.html.twig', [ 
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
    public function deleteTranslation(Request $request){

        /** @var TranslateService */
        $ttService  = $this->get('texttranslate.service');
        $id = $request->query->get('id');
        try {
            $ttService->deleteTranslation($id);
            $status = 'success';
        } catch (Exception $e) {
            $status = 'Something went wrong';
        }

        return new JsonResponse([
            'status' => $status
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getTranslations(Request $request){
        /** @var TranslateService $ttService */
        $ttService  = $this->get('texttranslate.service');
        $result  = []; 
        try {
            $result = [
                'custom_translations' => $ttService->getCustomeTranslationList()
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