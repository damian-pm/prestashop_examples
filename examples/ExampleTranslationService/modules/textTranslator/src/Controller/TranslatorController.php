<?php

namespace Modules\textTranslator\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Modules\textTranslator\Service\TranslatorService;

class TranslatorController extends FrameworkBundleAdminController
{
    public function indexAction(Request $request)
    {
        /**@var  TranslatorService  translateService */
        $translateService = $this->get('textTranslator.trans');
        $text = $request->request->get('word');

        return $this->render('@Modules/textTranslator/src/Resources/views/translator.html.twig', [
            'text' => $translateService->getTranslate($text,'','', 'pl_PL'),
            'number' => 1232
        ]);
    }
}