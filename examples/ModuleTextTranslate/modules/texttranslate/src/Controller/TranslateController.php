<?php

namespace PrestaShop\Module\TextTranslate\Controller;

use Exception;
use PrestaShop\Module\TextTranslate\Entity\TabLangCollection;
use PrestaShop\Module\TextTranslate\Form\TabLangCollectionType;
use PrestaShop\Module\TextTranslate\Form\TranslationAddType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\Module\TextTranslate\Service\TranslateService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $session    = new Session();
        /** @var TranslateService */
        $ttService  = $this->get('texttranslate.service');
        $tabLangs   = new TabLangCollection();
        $tabLangs->setTranslations($ttService->getCustomeTranslationList());    
        $tabLangs->setTablangs($ttService->getTabLangList());    
        $form       = $this->createForm(TabLangCollectionType::class, $tabLangs);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var TabLangCollection $data */
                $ttService->update( $form->getData() );
                $session->getFlashBag()->add('alert', [
                    'type'      => 'success',
                    'message'   => 'Updated success!'
                ]);
                return $this->redirect($request->getUri());
            } catch(Exception $e) {
                $session->getFlashBag()->add('alert', [
                    'type'      => 'danger',
                    'message'   => 'Updated failed!'
                ]);
            }
        }

        return $this->render('@Modules/texttranslate/src/Resources/views/index.html.twig', [ 
            'langs' => $ttService->getLangs(),
            'form' => $form->createView(),
            'url_clear_cache' => $this->generateUrl('admin_clear_cache'),
            'url_add_translation' => $this->generateUrl('translator_text_add_translation'),
            'url_delete_translation' => $this->generateUrl('translator_text_delete_translation')
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function newTranslationAction(Request $request){
        $session    = new Session();
        /** @var TranslateService */
        $ttService  = $this->get('texttranslate.service');

        $form       = $this->createForm(TranslationAddType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var Translation */
                $data = $form->getData();
                $ttService->addTranslation($data);
                $session->getFlashBag()->add('alert', [
                    'type'      => 'success',
                    'message'   => 'Updated success! Refresh page to see new translation.'
                ]);
            } catch (Exception $e) {
                $session->getFlashBag()->add('alert', [
                    'type'      => 'danger',
                    'message'   => 'Updated failder!'
                ]);
            }
        }

        return new JsonResponse([
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
        $id = $request->request->get('id');
        dump($request);
        try {
            $ttService->deleteTranslation($id);
            $status = 'ok';
        } catch (Exception $e) {
            $status = 'Something went wrong';
        }

        return new JsonResponse([
            'status' => $status
        ]);
    }
}