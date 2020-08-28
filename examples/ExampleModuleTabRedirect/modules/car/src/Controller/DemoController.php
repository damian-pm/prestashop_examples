<?php

namespace Modules\Car\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class DemoController extends FrameworkBundleAdminController
{

    public function demoAction()
    {
        return $this->render('@Modules/car/src/Resources/views/demo.html.twig', []);
    }
}